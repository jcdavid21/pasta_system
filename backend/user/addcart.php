<?php
require_once("../config/config.php");
session_start();

if (isset($_POST["prodId"]) && isset($_POST["qnty"])) {
    $account_id = $_SESSION["user_id"];
    $prod_id = $_POST["prodId"];
    $prod_qnty = $_POST["qnty"];
    $selectedSize = $_POST["selectedSize"];

    // Check if the product is already in the cart
    $query = "SELECT * FROM tbl_cart WHERE prod_id = ? AND account_id = ? AND status_id = 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $prod_id, $account_id);
    $stmt->execute();
    $result = $stmt->get_result();



    if ($result->num_rows > 0) {
        echo "exceeds";
    } else {

        $query2 = "INSERT INTO tbl_cart (prod_id, prod_qnty, account_id, prod_size) VALUES (?, ?, ?, ?)";
        $stmt2 = $conn->prepare($query2);
        $stmt2->bind_param("iiis", $prod_id, $prod_qnty, $account_id, $selectedSize);
        $stmt2->execute();
        $item_id = $stmt2->insert_id;

        echo "success";
    }
    exit();
}
?>
