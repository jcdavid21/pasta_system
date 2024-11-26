<?php 
session_start();
require_once("../reports/reports.php");

if(isset($_POST["prod_id"]) && isset($_POST["prod_name"]) 
    && isset($_POST["prod_price_small"]) && isset($_POST["prod_price_medium"]) && isset($_POST["prod_price_large"])) {

    $prod_id = $_POST["prod_id"];
    $prod_name = $_POST["prod_name"];
    $prod_price_small = $_POST["prod_price_small"];
    $prod_price_medium = $_POST["prod_price_medium"];
    $prod_price_large = $_POST["prod_price_large"];
    $prod_description = $_POST["prod_description"];


    $account_id = $_SESSION["admin_id"];

    $query = "UPDATE tbl_products SET prod_name=?, prod_price_small=?, prod_price_medium = ?, prod_price_large = ?, prod_description = ? WHERE prod_id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("siiisi", $prod_name, $prod_price_small, $prod_price_medium, $prod_price_large, $prod_description, $prod_id);
    $stmt->execute();


    $query2 = "SELECT ac_username FROM tbl_account WHERE account_id = ?";
    $stmt2 = $conn->prepare($query2);
    $stmt2->bind_param("i", $account_id);
    $stmt2->execute();
    $result = $stmt2->get_result();
    if($result->num_rows > 0){
        $data = $result->fetch_assoc();
        $username = $data["ac_username"];
        $act = "Updated Product ID: $prod_id";
        $type = "Admin";
        report($conn, $account_id, $username, $act, $type);
    }

    echo "success";

    $stmt->close();
    $conn->close();
}
?>
