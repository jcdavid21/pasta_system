<?php 
    session_start();
    unset($_SESSION["user_id"]);
?>

<script>
    localStorage.removeItem("userDetails");
    window.location.href =  "./login.php";
</script>