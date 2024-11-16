<?php
// Check if the form is submitted and 'item_id' is provided
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['item_id'])) {
    // Get the item ID from the POST data
    $item_id = $_POST['item_id'];

    // Validate the item_id (ensure it's a number)
    if (is_numeric($item_id)) {
        // Connect to the database
        $db = mysqli_connect("localhost", "root", "", "vogue");

        if (!$db) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare the SQL query to delete the record
        $query = "DELETE FROM dresses WHERE id = ?";

        // Prepare the statement
        $stmt = mysqli_prepare($db, $query);

        if ($stmt === false) {
            die("Error preparing the SQL statement: " . mysqli_error($db));
        }

        // Bind the item_id parameter to the prepared statement
        mysqli_stmt_bind_param($stmt, "i", $item_id);

        // Execute the query
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to the product list page after deletion
            header("Location: allProduct.php");
            exit();
        } else {
            // Handle errors during execution
            echo "Error deleting record: " . mysqli_stmt_error($stmt);
        }

        // Close the prepared statement and the database connection
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    } else {
        echo "Invalid item ID.";
    }
} else {
    echo "No item ID provided.";
}
?>
