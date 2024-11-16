<!doctype html>
<html>
<head>
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #000;
        margin: 0;
        padding: 0;
    }

    .container {
        display: flex;
        justify-content: center;
        margin-top: 100px;
    }

    .product-item {
        display: flex;
        align-items: flex-start;
        background-color: #fff;
        border: 4px solid #ffa500;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin: 20px;
        border-radius: 10px;
        width: 60%;
    }

    .product-item .image-container {
        width: 40%;
        margin-right: 20px;
    }

    .product-item .image-container img {
        width: 80%;
        height: 500px;
        border-radius: 10px;
        border: 3px solid #ffa500;
    }

    .product-item .content {
        width: 60%;
    }

    .product-item button {
        display: inline-block;
        margin-top: 1rem;
        padding: 0.8rem 2.8rem;
        border-radius: 5rem;
        border-top-left-radius: 0;
        border: 0.2rem solid #ffa500;
        cursor: pointer;
        background: none;
        color: #ffa500;
        font-size: 1rem;
        overflow: hidden;
        z-index: 0;
        position: relative;
    }

    .product-item button:hover {
        font-size: 1.5rem;
    }

    .product-item form {
        display: flex;
        flex-direction: column;
        width: 100%;
    }

    .product-item h2 {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #ffa500;
    }
    p {
        font-size: 18px;
        margin-bottom: 5px;
        color: #fff;
    }
    .product-item p {
        font-size: 18px;
        margin-bottom: 5px;
        color: #000;
    }

    .product-item .radio-group {
        display: flex;
        color: #000;
        margin-bottom: 10px;
    }

    .product-item .radio-group label {
        margin: 0 5px;
    }

    .product-item .quantity {
        display: flex;
        align-items: center;
        color: #000;
        margin-bottom: 10px;
    }

    .product-item .quantity input {
        width: 40px;
        text-align: center;
        margin: 0 10px;
       
    }
    input {
        border: 2px solid #ffa500;
        height: 35px;
    }

</style>
<link rel="stylesheet" href="navbar.css" />
</head>
<body>
    <div class="navbar">
        <div class="logo">
            <img src="img/voguelogo.png" width="100px">
        </div>
        <nav>
            <ul>
                <li><a href="userHomePage.php">HOME</a></li>
                <li><a href="store.php">PRODUCTS</a></li>
                <?php session_start(); if (!isset($_SESSION['user'])): ?>
                    <!-- Show SIGNIN & SIGNUP if user is not logged in -->
                    <li><a href="userlogin.php">SIGNIN & SIGNUP</a></li>
                <?php else: ?>
                    <!-- Show PROFILE if user is logged in -->
                    <li><a href="AddcartView.php">ADD TO CART</a></li>
                    <li><a href="userProfile.php">PROFILE</a></li>
                    <li><a href="logout.php">LOGOUT</a></li>
                <?php endif; ?>
                <li><a href="userHomePage.php#about">ABOUT</a></li>
                
            </ul>
        </nav>
    </div>
    <?php
    // Start session to use session variables if needed
    session_start();
    if (!isset($_SESSION['user'])) {
        header("Location: userlogin.php");
        exit();
    }

    $db = mysqli_connect("localhost", "root", "", "vogue");

    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the form data
    $dress_id = intval($_POST['dress_id']);
    $size = htmlspecialchars($_POST['size']);
    $color = htmlspecialchars($_POST['color']);
    $quantity = intval($_POST['quantity']);

    // Retrieve the dress details from the database
    $sql = "SELECT dress_name, dress_price, image_one FROM dresses WHERE id = $dress_id";
    $res = mysqli_query($db, $sql);

    // Check if the required POST data is set
    if (isset($_POST['dress_id']) && isset($_POST['size']) && isset($_POST['color']) && isset($_POST['quantity']) && isset($_POST['phone_number']) && isset($_POST['delivery_address']) && isset($_POST['bank_card_number'])) {
        $phone_number = htmlspecialchars($_POST['phone_number']);
        $delivery_address = htmlspecialchars($_POST['delivery_address']);
        $bank_card_number = htmlspecialchars($_POST['bank_card_number']);

        if ($res && mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            $dress_name = $row['dress_name'];
            $dress_price = $row['dress_price'];
            $image_one = $row['image_one'];  // Retrieve the image

            // Calculate the total price
            $total_price = $dress_price * $quantity;

            // Check if user is logged in
            if (isset($_SESSION['user'])) {
                $user_id = $_SESSION['user'];

                // Insert the order details into the database
                $insert_sql = "INSERT INTO orders (dress_id, size, color, quantity, total_price, phone_number, delivery_address, bank_card_number, user_id, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'New order')";
                $stmt = mysqli_prepare($db, $insert_sql);
                mysqli_stmt_bind_param($stmt, "ississsss", $dress_id, $size, $color, $quantity, $total_price, $phone_number, $delivery_address, $bank_card_number, $user_id);

                if (mysqli_stmt_execute($stmt)) {
                    echo "<h1>Order Confirmed</h1>";
                    echo "<p>Thank you for your purchase! Your order has been placed successfully.</p>";
                } else {
                    echo "<p>Error: Unable to place your order. Please try again later.</p>";
                }

                mysqli_stmt_close($stmt);
            } else {
                echo "<p>User not logged in. Please log in and try again.</p>";
            }
        } else {
            echo "<p>Dress not found.</p>";
        }

        // Close the database connection
        mysqli_close($db);
    } else if (isset($_POST['dress_id']) && isset($_POST['size']) && isset($_POST['color']) && isset($_POST['quantity'])) {
        
        if ($res && mysqli_num_rows($res) > 0) {
            $row = mysqli_fetch_assoc($res);
            $dress_name = $row['dress_name'];
            $dress_price = $row['dress_price'];
            $image_one = $row['image_one'];  // Retrieve the image

            // Calculate the total price
            $total_price = $dress_price * $quantity;

            // Display the details using proper HTML and PHP
            echo "<div class='container'>";
            echo "<div class='product-item'>";
            echo "<div class='image-container'>";
            echo "<img src='../admin/dress_images/" . htmlspecialchars($image_one) . "' class='main-image' alt='Main Dress Image'>";
            echo "</div>";
            echo "<div class='content'>";
            echo "<h2>$dress_name</h2>";
            echo "<p>Selected Size: $size</p>";
            echo "<p>Selected Color: $color</p>";
            echo "<p>Quantity: $quantity</p>";
            echo "<p>Total Price: Rs $total_price</p>";
            echo '<form action="buy_process.php" method="post">';
            echo '<input type="hidden" name="dress_id" value="' . $dress_id . '">';
            echo '<input type="hidden" name="size" value="' . $size . '">';
            echo '<input type="hidden" name="color" value="' . $color . '">';
            echo '<input type="hidden" name="quantity" value="' . $quantity . '">';
            echo '<input type="hidden" name="total_price" value="' . $total_price . '">';
            echo '<label for="phone_number">Phone Number:</label>';
            echo '<input type="text" name="phone_number" id="phone_number" required>';
            echo '<label for="delivery_address">Delivery Address:</label>';
            echo '<input type="text" name="delivery_address" id="delivery_address" required>';
            echo '<label for="bank_card_number">Bank Card Number:</label>';
            echo '<input type="text" name="bank_card_number" id="bank_card_number" required>';
            echo '<button type="submit">Submit</button>';
            echo '</form>';
            echo "</div>"; // Close .content
            echo "</div>"; // Close .product-item
            echo "</div>"; // Close .container
        } else {
            echo "<p>Dress not found.</p>";
        }

        // Close the database connection
        mysqli_close($db);
    } else {
        echo "<p>Invalid form submission. Please go back and try again.</p>";
    }
    ?>
</body>
</html>