<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cart_id = $_POST['cart_id'];

    // Use mysqli_connect to establish a MySQLi connection
    $db = mysqli_connect("localhost", "root", "", "vogue");

    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare a statement using MySQLi
    $stmt = mysqli_prepare($db, "DELETE FROM addcart WHERE id = ?");
    if ($stmt) {
        // Bind the cart_id parameter to the statement
        mysqli_stmt_bind_param($stmt, "i", $cart_id);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Check if rows were affected
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            header("Location: addcartView.php");
            exit();
        } else {
            echo "No rows affected.";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Failed to prepare the statement.";
    }

    // Close the MySQLi connection
    mysqli_close($db);
}
?>
