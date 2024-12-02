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

        if($status_id == 2)
        {
            $prod_price = 0;
            $query3 = "SELECT 
                            CASE 
                                WHEN tc.prod_size = 'small' THEN tp.prod_price_small 
                                WHEN tc.prod_size = 'medium' THEN tp.prod_price_medium 
                                WHEN tc.prod_size = 'large' THEN tp.prod_price_large 
                                ELSE 0 -- Optional: Default value if no conditions match
                            END AS product_price
                        FROM tbl_products tp
                        INNER JOIN tbl_cart tc ON tp.prod_id = tc.prod_id
                        WHERE tp.prod_id = (
                            SELECT tc.prod_id 
                            FROM tbl_cart tc 
                            WHERE tc.item_id = ?
                        );";
            $stmt3 = $conn->prepare($query3);
            $stmt3->bind_param("i", $item_id);
            $stmt3->execute();
            $result = $stmt3->get_result();
            if($result->num_rows > 0){
                $data = $result->fetch_assoc();
                $prod_price = $data["product_price"];
            }

            $query4 = "INSERT INTO tbl_delivered_orders (item_id, prod_price) VALUES (?, ?)";
            $stmt4 = $conn->prepare($query4);
            $stmt4->bind_param("id", $item_id, $prod_price);
            $stmt4->execute();
        }

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