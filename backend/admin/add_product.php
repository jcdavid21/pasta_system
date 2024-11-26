<?php
session_start();
require_once("../reports/reports.php");

if(isset($_POST["productName"]) && isset($_POST["productPriceSmall"]) && 
    isset($_POST["productPriceMedium"]) && isset($_POST["productPriceLarge"]) && isset($_POST["productType"]) && isset($_FILES["productImage"])) {

    $admin_id = $_SESSION["admin_id"];
    $prod_name = $_POST['productName'];
    $prod_price_small = $_POST['productPriceSmall'];
    $prod_price_medium = $_POST['productPriceMedium'];
    $prod_price_large = $_POST['productPriceLarge'];
    $prod_type = $_POST['productType'];
    $targetDir = "";

    $query = "SELECT * FROM tbl_product_type WHERE prod_type_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $prod_type);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $targetDir = "../../assets/products/";

    if(isset($_FILES['productImage'])){
        $prod_img = $_FILES['productImage'];

        $targetFile = $targetDir . basename($prod_img['name']);
        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != 'webp') {
            echo "error_image_format";
            exit();
        }

        if (!move_uploaded_file($prod_img["tmp_name"], $targetFile)) {
            echo "error_uploading_image";
            exit();
        }
    }

    $query = "INSERT INTO tbl_products (prod_name, prod_price_small, prod_price_medium, prod_price_large, prod_type, prod_img) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("siiiss", $prod_name, $prod_price_small, $prod_price_medium, $prod_price_large, $prod_type, $prod_img['name']);
    
    if($stmt->execute()){
        echo "success";
    } else {
        echo "error";
    }


    
} else {
    echo "error_invalid_request";
}
?>
