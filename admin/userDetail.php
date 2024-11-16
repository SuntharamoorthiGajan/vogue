<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: Arial, sans-serif;
        }
        .cart-table {
            width: 90%;
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
            font-size: 18px;
            color: #ffa500;
        }
        .cart-table td {
            font-size: 16px;
        }
        .cart-table td form button {
            width: 90%;
            padding: 10px;
            font-size: 16px;
            color: #fff;
            border: none;
            cursor: pointer;
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
<table class="cart-table">
    <thead>
        <tr>
            <th scope="col">User Name</th>
            <th scope="col">User Image</th>
            <th scope="col">User Email</th>
            <th scope="col">Phone Number</th>
            <th scope="col">User Address</th>
            <th scope="col">Date Of Birth</th>
        </tr>
    </thead>
    <tbody>
        
    <?php 
        try {
            $db = mysqli_connect("localhost", "root", "", "vogue");

            $query = "SELECT * FROM user_registration WHERE 1=1";

            $res = mysqli_query($db, $query);

            if ($res && mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
        ?>
            <tr>
                <td><?php echo htmlspecialchars($row['usr_Name']); ?></td>
                <td><img src="../user/user_images/<?php echo htmlspecialchars($row['pro_photo']); ?>" style="width:150px; height:150px;"></td>
                <td><?php echo htmlspecialchars($row['Email']); ?></td>
                <td><?php echo htmlspecialchars($row['Con_Number']); ?></td>
                <td>Rs.<?php echo htmlspecialchars($row['Address']); ?></td>
                <td><?php echo htmlspecialchars($row['Date_Of_Birth']); ?></td>
            </tr>
        <?php
                }
            } else {
                echo "<tr><td colspan='9'>No results found.</td></tr>";
            }
        } catch (Exception $e) {
            echo "<tr><td colspan='9'>Error: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
        }
        ?>
        
    </tbody>
</table>
</body>
</html>
