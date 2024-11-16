<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: userlogin.php");
    exit();
}

// Check if the required POST parameters are set
if (isset($_POST['dress_id']) && isset($_POST['size']) && isset($_POST['color']) && isset($_POST['quantity'])) {
    $dress_id = intval($_POST['dress_id']);
    $size = htmlspecialchars($_POST['size']);
    $color = htmlspecialchars($_POST['color']);
    $quantity = intval($_POST['quantity']);
    $user_email = $_SESSION['user'];  // Assuming user session stores email

    // Establish database connection
    $db = mysqli_connect("localhost", "root", "", "vogue");

    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Query to get the dress details
    $sql = "SELECT * FROM dresses WHERE id = $dress_id";
    $res = mysqli_query($db, $sql);

    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $dress_name = mysqli_real_escape_string($db, $row['dress_name']);  // Escape special characters
        $dress_price = $row['dress_price'];
        $image_one = mysqli_real_escape_string($db, $row['image_one']);  // Escape special characters

        // Calculate the total price
        $total_price = $dress_price * $quantity;

        // Escape user inputs as well
        $size = mysqli_real_escape_string($db, $size);
        $color = mysqli_real_escape_string($db, $color);
        $user_email = mysqli_real_escape_string($db, $user_email);

        // Insert data into AddCart table
        $sql_insert = "INSERT INTO AddCart (dress_id, dress_name, total_price, image, quantity, size, color, user_email) 
                       VALUES ('$dress_id', '$dress_name', '$total_price', '$image_one', '$quantity', '$size', '$color', '$user_email')";

        if (mysqli_query($db, $sql_insert)) {
            header("Location: store.php");
            exit();
        } else {
            echo "Error: " . $sql_insert . "<br>" . mysqli_error($db);
        }
    } else {
        echo "<p>Dress not found.</p>";
    }

    // Close the database connection
    mysqli_close($db);
} else {
    echo "<p>Invalid form submission. Please go back and try again.</p>";
}
?>
