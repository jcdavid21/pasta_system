<?php 

    require_once("../config/config.php");

    if(isset($_POST["username"]) && isset($_POST["password"]))
    {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "SELECT * FROM tbl_account WHERE ac_username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();   
        $result = $stmt->get_result();

        if($result->num_rows > 0){
            $query = "UPDATE tbl_account SET ac_password = ? WHERE ac_username =  ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $hashedPassword, $username);
            $stmt->execute();
            echo "success";
        }else{
            echo "invalid";
        }
    }

?>