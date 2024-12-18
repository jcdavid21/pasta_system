<?php 
require_once("../config/config.php");
session_start();

if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
    $date = date('Y-m-d');


    // Check if a file was uploaded
    if (isset($_FILES['receipt']) && $_FILES['receipt']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../receipts/';
        $originalFileName = basename($_FILES['receipt']['name']);
        $fileExtension = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));

        // Validate file type
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'svg', 'webp'];
        if (!in_array($fileExtension, $allowedExtensions)) {
            echo "invalid_file_type";
            exit();
        }

        // Generate a unique file name
        $uniqueFileName = uniqid() . '.' . $fileExtension;
        $uploadFile = $uploadDir . $uniqueFileName;

        // Move uploaded file to target directory
        if (move_uploaded_file($_FILES['receipt']['tmp_name'], $uploadFile)) {
            $ref_number = $_POST["refNumber"];
            $depositAmount = $_POST["depositAmount"];
            $claim_date = $_POST["claimDate"];
            $order_remarks = $_POST["remarks"] ? $_POST["remarks"] : 'No order remarks';
            $status_id = 3;
            

            // Insert receipt for each branch
            $receiptQuery = "INSERT INTO tbl_receipt (account_id, receipt_img, receipt_number, deposit_amount, uploaded_date) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($receiptQuery);
            $stmt->bind_param("issis", $user_id, $uniqueFileName, $ref_number, $depositAmount, $date);

            if ($stmt->execute()) {
                // Update the cart status to 'claimed' (status_id = 3)
                $cartQuery = "UPDATE tbl_cart SET status_id = ?, order_date = ?, claim_date = ?, order_remarks = ? WHERE account_id = ? AND status_id = 1";
                $stmt = $conn->prepare($cartQuery);
                $stmt->bind_param("isssi", $status_id, $date, $claim_date, $order_remarks, $user_id);

                if ($stmt->execute()) {
                    echo "success";
                } else {
                    echo "error_updating_cart";
                    exit();
                }
            } else {
                echo "error_inserting_receipt";
                exit();
            }
        } else {
            echo "file_upload_error";
            exit();
        }
    } else {
        echo "no_file_or_upload_error";
        exit();
    }
} else {
    echo "user_not_logged_in";
}
?>
