<?php
    session_start();
    require_once("../config/config.php");

    if(isset($_GET["itemId"])){
        $user_id = $_SESSION["user_id"];
        $item_id  = $_GET["itemId"];
        // $prod_id = $_GET["prodId"];
        // $branch_id = $_GET["branchId"];

        $query = "DELETE FROM tbl_cart WHERE item_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $item_id);
        $stmt->execute();
        echo "deleted";
    }
?>