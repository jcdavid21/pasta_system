<?php
    require_once("../config/config.php");
    session_start();

    // Check if user is logged in and required POST variables are set
    if (isset($_SESSION["user_id"]) && isset($_POST["feedback"]) && isset($_POST["prod_id"])) {
        $feedback = $_POST["feedback"];
        $account_id = $_SESSION["user_id"];
        $prod_id = $_POST["prod_id"];
        $current_date = date("Y-m-d");

        // Validate or sanitize input (optional)
        $feedback = trim($feedback);

        // Prepare the SQL statement
        $query = "INSERT INTO tbl_item_feedback (prod_id, fd_comment, account_id, fd_date) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        
        if ($stmt === false) {
            // Handle error when preparing statement
            die("Error preparing statement: " . $conn->error);
        }

        // Bind parameters
        $stmt->bind_param("isis", $prod_id, $feedback, $account_id, $current_date);

        // Execute and check for success
        if ($stmt->execute()) {
            echo "success"; // Return success message
        } else {
            echo "Error executing query: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Invalid request. Please ensure all required fields are provided.";
    }

    // Close the database connection
    $conn->close();
?>
