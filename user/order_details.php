<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: userlogin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cart_id = $_POST['cart_id'];
    $phone_number = $_POST['phone_number'];
    $delivery_address = $_POST['delivery_address'];
    $bank_card_number = $_POST['bank_card_number'];
    $user_email = $_SESSION['user'];

    // Database connection
    $db = mysqli_connect("localhost", "root", "", "vogue");

    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch item details from addcart table
    $sql = "SELECT * FROM addcart WHERE id = ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "i", $cart_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Insert order details into the orders table
        $insert_sql = "INSERT INTO orders (dress_id, size, color, total_price, quantity, phone_number, delivery_address, bank_card_number, user_id, status) 
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'New order')";
        $insert_stmt = mysqli_prepare($db, $insert_sql);
        mysqli_stmt_bind_param($insert_stmt, "issdissss", $row['dress_id'], $row['size'], $row['color'], $row['total_price'], $row['quantity'], $phone_number, $delivery_address, $bank_card_number, $user_email);
        mysqli_stmt_execute($insert_stmt);

        // Remove item from addcart table after successful order placement
        $delete_sql = "DELETE FROM addcart WHERE id = ?";
        $delete_stmt = mysqli_prepare($db, $delete_sql);
        mysqli_stmt_bind_param($delete_stmt, "i", $cart_id);
        mysqli_stmt_execute($delete_stmt);

        // Redirect to order confirmation or cart view
        header("Location: AddcartView.php");
        exit();
    } else {
        echo "No such item found in cart.";
    }

    mysqli_close($db);
}
?>
