<?php
require_once("../config/config.php");
session_start();

if(isset($_POST["fName"]) && isset($_POST["lName"])
    && isset($_POST["username"]) && isset($_POST["address"])
    && isset($_POST["contact"]) && isset($_SESSION["user_id"])) {
    
    $acc_id = $_SESSION["user_id"];
    $first_name = $_POST["fName"];
    $middle_name = $_POST["mName"];
    $last_name = $_POST["lName"];
    $username = $_POST["username"];
    $address = $_POST["address"];
    $contact = $_POST["contact"];
    $gender = $_POST["gender"];

    $password = $_POST["password"];  // current password
    $newPassword = $_POST["confirmPass"];  // new password

    // First, verify if the current password is correct
    if (!empty($password)) {
        $query = "SELECT * FROM tbl_account WHERE account_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $acc_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $hashedPassword = $data["ac_password"];

            // Check if the current password is correct
            if (!password_verify($password, $hashedPassword)) {
                echo "invalid";  // Password is incorrect
                exit();
            }
        }
    } else {
        echo "empty";  // Current password is empty
        exit();
    }
    

    if(!empty($username)){
        $query = "SELECT * FROM tbl_account WHERE ac_username = ? AND account_id != ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $username, $acc_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0){
            echo "existed";  // Username already exists
            exit();
        }
    }

    // If a new password is provided, update it
    if (!empty($newPassword)) {
        $hashPassword = password_hash($newPassword, PASSWORD_DEFAULT);  // Hash the new password
        $query = "UPDATE tbl_account 
                  SET ac_password = ? 
                  WHERE account_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $hashPassword, $acc_id);
        $stmt->execute();
    }

    // Update the other account details (username, first name, etc.)
    $query = "UPDATE tbl_account 
              SET ac_username = ? 
              WHERE account_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $username, $acc_id);
    $stmt->execute();

    $query = "UPDATE tbl_account_details 
              SET first_name = ?, middle_name = ?, last_name = ?, address = ?, contact = ?, gender = ?
              WHERE account_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssi", $first_name, $middle_name, $last_name, $address, $contact, $gender, $acc_id);
    $stmt->execute();

    echo "updated";  // Indicate successful update
    exit();
}
?>
