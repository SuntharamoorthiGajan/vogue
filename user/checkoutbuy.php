<?php 
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: userlogin.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['checkout_all'])) {
    // Connect to database
    $db = mysqli_connect("localhost", "root", "", "vogue");

    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $user_email = $_SESSION['user'];
    $phone_number = mysqli_real_escape_string($db, $_POST['phone_number']);
    $delivery_address = mysqli_real_escape_string($db, $_POST['delivery_address']);
    $bank_card_number = mysqli_real_escape_string($db, $_POST['bank_card_number']);

    // Begin transaction
    mysqli_begin_transaction($db);

    try {
        // Get cart items
        $cart_sql = "SELECT * FROM addcart WHERE user_email = '$user_email'";
        $cart_result = mysqli_query($db, $cart_sql);

        if ($cart_result && mysqli_num_rows($cart_result) > 0) {
            // Insert order and order items in a loop
            while ($row = mysqli_fetch_assoc($cart_result)) {
                // Insert order details for each cart item
                $order_sql = "INSERT INTO orders (dress_id, size, color, total_price, quantity, phone_number, delivery_address, bank_card_number, user_id, status) VALUES ('".$row['dress_id']."', '".$row['size']."', '".$row['color']."', '".$row['total_price']."', '".$row['quantity']."', '$phone_number', '$delivery_address', '$bank_card_number', '$user_email', 'New order')";
                if (!mysqli_query($db, $order_sql)) {
                    throw new Exception("Error inserting order: " . mysqli_error($db));
                }
            }

            // Clear the cart
            $delete_cart_sql = "DELETE FROM addcart WHERE user_email = '$user_email'";
            if (!mysqli_query($db, $delete_cart_sql)) {
                throw new Exception("Error clearing cart: " . mysqli_error($db));
            }
        } else {
            throw new Exception("No items found in the cart.");
        }

        // Commit transaction
        mysqli_commit($db);

        // Redirect to a confirmation page
        header("Location: AddcartView.php");
        exit();

    } catch (Exception $e) {
        // Rollback transaction on error
        mysqli_rollback($db);
        echo "Failed: " . $e->getMessage();
    }

    // Close the database connection
    mysqli_close($db);
} else {
    // Redirect to cart page if accessed directly
    header("Location: cart.php");
    exit();
}
?>
