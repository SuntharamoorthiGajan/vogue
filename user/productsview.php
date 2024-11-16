<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>VOGUE - Product Details</title>
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
            height: 400px;
            border-radius: 10px;
            border: 3px solid #ffa500;
        }
        .product-item .content {
            width: 60%;
        }
        .product-item .small-images {
            display: flex;
            margin-top: 10px;
        }
        .product-item .small-images img {
            width: 70px;
            height: 70px;
            border: 2px solid #ffa500;
            margin: 0 5px;
            border-radius: 5px;
            cursor: pointer;
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
    <div class="container">
        <?php
        
        $db = mysqli_connect("localhost", "root", "", "vogue");

        if (!$db) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if (isset($_GET['dress_id'])) {
            $dress_id = intval($_GET['dress_id']);
            $sql = "SELECT * FROM dresses WHERE id = $dress_id";
            $res = mysqli_query($db, $sql);

            if ($res && mysqli_num_rows($res) > 0) {
                $row = mysqli_fetch_assoc($res);
                ?>
                <div class='product-item'>
                    <div class='image-container'>
                        <img src='../admin/dress_images/<?php echo htmlspecialchars($row['image_one']); ?>' class='main-image' alt='Main Dress Image'>
                    </div>
                    <div class='content'>
                        <h2><?php echo htmlspecialchars($row['dress_name']); ?></h2>
                        <p>Brand Name: <?php echo htmlspecialchars($row['company_name']); ?></p>
                        <p>Dress Price: Rs <?php echo htmlspecialchars($row['dress_price']); ?></p>
                        <form method='POST'>
                            <input type='hidden' name='dress_id' value='<?php echo $row['id']; ?>'>
                            <div class='radio-group'>
                                <label>Size:</label>
                                <?php
                                $sizes = explode(',', $row['dress_sizes']);
                                foreach ($sizes as $size) {
                                    echo "<label><input type='radio' name='size' value='" . htmlspecialchars($size) . "'> " . htmlspecialchars($size) . "</label> ";
                                }
                                ?>
                            </div>
                            <div class='radio-group'>
                                <label>Color:</label>
                                <?php
                                $colors = explode(',', $row['dress_colors']);
                                foreach ($colors as $color) {
                                    echo "<label><input type='radio' name='color' value='" . htmlspecialchars($color) . "'> " . htmlspecialchars($color) . "</label> ";
                                }
                                ?>
                            </div>
                            <div class='quantity'>
                                <label>Quantity:</label>
                                <input type='number' name='quantity' value='1' min='1'>
                            </div>
                            <div class='small-images'>
                                <img src='../admin/dress_images/<?php echo htmlspecialchars($row['image_two']); ?>' alt='Thumbnail 1' onclick='changeImage("../admin/dress_images/<?php echo htmlspecialchars($row['image_two']); ?>")'>
                                <img src='../admin/dress_images/<?php echo htmlspecialchars($row['image_three']); ?>' alt='Thumbnail 2' onclick='changeImage("../admin/dress_images/<?php echo htmlspecialchars($row['image_three']); ?>")'>
                                <img src='../admin/dress_images/<?php echo htmlspecialchars($row['image_one']); ?>' alt='Thumbnail 3' onclick='changeImage("../admin/dress_images/<?php echo htmlspecialchars($row['image_one']); ?>")'>
                            </div>
                            <div class='buttons'>
                                <button type="button" onclick="setFormAction('buy_process.php')">Buy Now</button>
                                <button type="button" onclick="setFormAction('itemaddcart_process.php')">Add to Cart</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
            } else {
                echo "<p>Dress not found.</p>";
            }
        } else {
            echo "<p>Invalid request.</p>";
        }

        mysqli_close($db);
        ?>
    </div>

    <script>
        function changeImage(newImage) {
            document.querySelector('.main-image').src = newImage;
        }
        
        function setFormAction(action) {
            const form = document.querySelector('.product-item form');
            form.action = action; // Set the form's action attribute
            form.method = 'POST'; // Make sure the method is set to POST
            form.submit(); // Submit the form
        }
    </script>
</body>
</html>
