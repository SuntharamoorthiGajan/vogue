<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $id0 = $_POST['item_id'];
    $price = $_POST['price'];
    $dress_sizes = $_POST['dress_sizes'];
    $dress_colors = $_POST['dress_colors'];

    // Connect to the database
    $db = mysqli_connect("localhost", "root", "", "vogue");

    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare the SQL query to update the record
    $sql = "UPDATE dresses SET dress_price = ?, dress_sizes = ?, dress_colors = ? WHERE id = ?";

    // Prepare the statement
    $stmt = mysqli_prepare($db, $sql);

    if ($stmt === false) {
        die("Error preparing the SQL statement: " . mysqli_error($db));
    }

    // Bind the parameters to the statement
    mysqli_stmt_bind_param($stmt, "sssi", $price, $dress_sizes, $dress_colors, $id0);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        // Redirect to the success page or display a success message
        echo "Record updated successfully!";
        header("Location: allproduct.php"); // Redirect after successful update
        exit();
    } else {
        // Handle errors
        echo "Error updating record: " . mysqli_stmt_error($stmt);
    }

    // Close the prepared statement and the database connection
    mysqli_stmt_close($stmt);
    mysqli_close($db);
} else {
    echo "Invalid request.";
}
?>
