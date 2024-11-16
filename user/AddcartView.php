<?php 
session_start(); 

if (!isset($_SESSION['user'])) {
    header("Location: userlogin.php");
    exit();
}

$user_email = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Vogue</title>
    
    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: Arial, sans-serif;
        }
        .cart-table {
            width: 80%;
            text-align: center;
            margin: 100px auto;
            border-collapse: collapse;
            color: #fff;
        }
        .cart-table th, .cart-table td {
            border: 1px solid #ddd;
            padding: 15px;
            vertical-align: middle;
        }
        .cart-table th {
            background-color: #444;
            font-size: 18px;
            color: #fff;
        }
        .cart-table td {
            font-size: 16px;
            background-color: #222;
        }
        .cart-table img {
            width: 150px;
            height: 150px;
        }
        .checkout-row {
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            font-size: 19px;
            background-color: #111;
            color: #fff;
        }
        .checkout-row h1 {
            margin: 0;
        }
        .checkout-button {
            text-align: center;
        }
        .cart-table .btn1, 
        .cart-table .btn2, 
        .checkout-button button,
        form button {
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
            text-decoration: none;
        }
        .cart-table .btn1:hover,
        .cart-table .btn2:hover,
        .checkout-button button:hover,
        form button:hover {
            font-size: 1.5rem;
            background-color: #fff3e0;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }
        .modal-content {
            background-color: #222;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
        .modal-header, .modal-footer {
            padding: 10px;
            color: #fff;
        }
        .modal-footer {
            text-align: right;
        }
        .modal-button {
            margin: 5px;
            padding: 10px 20px;
            border: none;
            background-color: #ffa500;
            color: #fff;
            cursor: pointer;
        }
        .modal-button:hover {
            background-color: #ff8c00;
        }
        input[type="text"] {
            width: calc(100% - 22px); /* Adjust width to fit within form layout */
            padding: 10px;
            margin: 5px 0;
            border: 2px solid #ffa500;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
            font-size: 16px;
        }
        input[type="text"]:focus {
            border-color: #ff8c00;
            outline: none;
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
                <?php  if (!isset($_SESSION['user'])): ?>
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

    <table class="cart-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Dress Name</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Size</th>
                <th>Color</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $total_purchase_price = 0;
        $db = mysqli_connect("localhost", "root", "", "vogue");

        if (!$db) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "SELECT * FROM addcart WHERE user_email = '$user_email'";
        $result = mysqli_query($db, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $total_purchase_price += $row['total_price'];
        ?>
                <tr>
                    <td><img src="../admin/dress_images/<?php echo htmlspecialchars($row['image']); ?>" alt="Dress Image" /></td>
                    <td><?php echo htmlspecialchars($row['dress_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                    <td>Rs. <?php echo htmlspecialchars($row['total_price']); ?></td>
                    <td><?php echo htmlspecialchars($row['size']); ?></td>
                    <td><?php echo htmlspecialchars($row['color']); ?></td>
                    <td>
                        <form action="deletecart.php" method="post">
                            <input type="hidden" name="cart_id" value="<?php echo htmlspecialchars($row['id']); ?>" />
                            <button type="submit" class="btn1">Delete</button>
                        </form>
                        <button type="button" class="btn2" onclick="openModal(<?php echo htmlspecialchars($row['id']); ?>)">Buy</button>
                    </td>
                </tr>
        <?php
            }
        ?>
            <tr>
                <td colspan="7" class="checkout-row">
                    <h1>Total: Rs. <?php echo number_format($total_purchase_price, 2); ?></h1>
                    <div class="checkout-button">
                        <form id="checkoutForm" action="checkoutbuy.php" method="post">
                            <input type="hidden" name="checkout_all" value="1">
                            <label for="phone_number">Phone Number:</label>
                            <input type="text" id="phone_number" name="phone_number" required><br>
                            
                            <label for="delivery_address">Delivery Address:</label>
                            <input type="text" id="delivery_address" name="delivery_address" required></textarea><br>
                            
                            <label for="bank_card_number">Bank Card Number:</label>
                            <input type="text" id="bank_card_number" name="bank_card_number" required><br>
                            
                            <button type="submit" class="modal-button">Place Order</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php
        } else {
            echo '<tr><td colspan="7"><p style="font-size: 19px; text-align:center;">No items in cart.</p></td></tr>';
        }

        // Close the database connection
        mysqli_close($db);
        ?>
        </tbody>
    </table>

    <!-- Modal for Order Details -->
    <div id="orderModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h2>Enter Your Order Details</h2>
            </div>
            <div class="modal-body">
                <form id="orderForm" action="order_details.php" method="post">
                    <input type="hidden" id="modal_cart_id" name="cart_id">
                    <label for="phone_number">Phone Number:</label>
                    <input type="text" id="phone_number" name="phone_number" required><br>
                    
                    <label for="delivery_address">Delivery Address:</label>
                    <input type="text" id="delivery_address" name="delivery_address" required></textarea><br>
                    
                    <label for="bank_card_number">Bank Card Number:</label>
                    <input type="text" id="bank_card_number" name="bank_card_number" required><br>
                    
                    <button type="submit" class="modal-button">Place Order</button>
                </form>
            </div>
            <div class="modal-footer">
                <form id="orderForm" action="AddcartView.php">
                    <button class="modal-button close">Cancel</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Modal handling
        var modal = document.getElementById("orderModal");
        var span = document.getElementsByClassName("close")[0];

        function openModal(cartId) {
            document.getElementById("modal_cart_id").value = cartId;
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
