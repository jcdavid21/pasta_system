<?php 
    session_start();
    require_once("../reports/trans.php");

    if(isset($_POST["item_id"]) && isset($_POST["status_id"])){
        $item_id = $_POST["item_id"];
        $cashier_id =  $_SESSION["admin_id"];
        $status_id = $_POST["status_id"];
        $order_date = date('Y-m-d');
        $prod_name = '';
        

        $query = "UPDATE tbl_cart SET status_id = ?, order_date = ? WHERE item_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("isi", $status_id, $order_date, $item_id);
        $stmt->execute();

        $query2 = "SELECT ac.ac_username, ac.role_id, tr.role_name FROM tbl_account ac 
        INNER JOIN tbl_role tr ON ac.role_id = tr.role_id Where ac.account_id = ?;";
        $stmt2 = $conn->prepare($query2);
        $stmt2->bind_param("i", $cashier_id);
        $stmt2->execute();
        $result = $stmt2->get_result();
        if($result->num_rows > 0){
            $data = $result->fetch_assoc();
            $user_name = $data["ac_username"];
            $role_id = $data["role_id"];
            $current_date = date('Y-m-d');
            $activity = '';
            if($status_id == 2){
                $activity = "Claimed item ".$prod_name;
                transaction($conn, $cashier_id, $user_name, $role_id, $current_date, $activity, $item_id);
            }
           
        }
        echo "success";
    }

?>