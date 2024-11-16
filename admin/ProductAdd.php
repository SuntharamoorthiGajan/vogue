<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VOGUE</title>
    <style>
        

        .container {
            display: flex;
            flex-wrap: wrap;
            font-size: 24px;
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin-top: 10%;
        }

        * {
            box-sizing: border-box;
        }

        body {
            background: #000;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: 'Montserrat', sans-serif;
            height: 100vh;
            margin: -20px 0 50px;
        }

        div {
            box-sizing: border-box;
        }

        .form-style-5 {
            max-width: 60%;
            padding: 10px 20px;
            background: #000;
            margin: 10px auto;
            margin-top: 20%;
            padding: 20px;
            font-family: "Lucida Console", "Courier New", monospace;
        }

        .form-style-5 legend {
            font-size: 2em;
            margin-bottom: 10px;
            color: #ffa500;
        }

        .form-style-5 input[type="text"],
        .form-style-5 input[type="file"],
        .form-style-5 textarea,
        .form-style-5 input[type="number"] {
            font-family: "Lucida Console", "Courier New", monospace;
            border: none;
            font-size: 15px;
            padding: 10px;
            width: 100%;
            background-color: #fff;
            color: #000;
            margin-bottom: 30px;
        }

        .form-style-5 input[type="submit"] {
            position: relative;
            font-family: "Lucida Console", "Courier New", monospace;
            display: block;
            color: #fff;
            font-size: 25px;
            text-align: center;
            width: 100%;
            margin: 5px;
            padding: 10px 20px;
            background-color: #ffa500;
            
        }

        .gender-group {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
            color: #fff;
            font-size: 1.5em;
        }

        .gender-group label {
            margin-right: 10px;
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
					<?php session_start(); if (!isset($_SESSION['user'])): ?>
						<li><a href="adminlogin.php">SIGNIN & SIGNUP</a></li>
					<?php else: ?>
                        <li><a href="ProductAdd.php">ADD PRODUCT</a></li>
						<li><a href="allProduct.php">ALL PRODUCT</a></li>
						<li><a href="soldDetail.php">ORDER DETAIL</a></li>
						<li><a href="userDetail.php">USER DETAIL</a></li>
						<li><a href="adminProfile.php">PROFILE</a></li>
						<li><a href="logout.php">LOGOUT</a></li>
					<?php endif; ?>
					
	            </ul>
        </nav>
    </div>
    <?php
        
        if (!isset($_SESSION['user'])) {
            header("Location: adminlogin.php");
            exit();
        }
    ?>
    <div class="form-style-5">
        <form action="productsaddHandler.php" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Dress Add Information</legend>
                <p>
                    <input type="text" name="DressType" placeholder="Dress Type">
                    <textarea name="DressName" placeholder="Dress name"></textarea>
                    <input type="file" name="imageOne" placeholder="Upload a Picture">
                    <input type="file" name="imageTwo" placeholder="Upload a Picture">
                    <input type="file" name="imageThree" placeholder="Upload a Picture">
                    <input type="text" name="txtcom_name" placeholder="Company Name">
                    <input type="number" name="DressPrice" placeholder="Dress price">
                    <input type="text" name="DressSize" placeholder="Dress Size">
                    <input type="text" name="DressColors" placeholder="Dress Colors">
                </p>
                <div class="gender-group">
                    <label>Select Gender</label>
                    <label>
                        <input type="radio" name="gender" value="Men"> Men
                    </label>
                    <label>
                        <input type="radio" name="gender" value="Women"> Women
                    </label>
                    <label>
                        <input type="radio" name="gender" value="Children"> Children
                    </label>
                </div>
                <p>
                    <input type="submit" value="Add Post" name="submit">
                </p>
            </fieldset>
        </form>
    </div>
</body>
</html>
