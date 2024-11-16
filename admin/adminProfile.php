<!doctype html>
<html>
<head>
<meta charset="utf-8">
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
			background: #fff;
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
			font-family: 'Montserrat', sans-serif;
			height: 100vh;
			margin: -20px 0 50px;
		}

        .prof-container {
            display: flex;
            flex-wrap: wrap;
            font-size: 24px;
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
        }

        .product-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center; 
            
            background-color: #000;
            box-shadow: 0 1px 4px;
            padding: 20px;  /* Added padding for spacing */
            font-family: 'Arial', sans-serif;  /* Changed font for readability */
        }

        .product-item img {
            width: 200px;
            height: 200px;
            border-radius: 100%;
            margin-bottom: 10px;
            border: 5px solid white;  
        }

        .product-item table {
            font-size: 20px;  
            color: #fff;  
        }

        .product-item table td {
            padding: 10px; 
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
        if (isset($_SESSION['user'])) {
            $db = mysqli_connect("localhost", "root", "", "vogue");
            if (!$db) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $email = mysqli_real_escape_string($db, $_SESSION['user']);
            $sel_sql = "SELECT * FROM admindetail WHERE Email='$email'";
            $res = mysqli_query($db, $sel_sql);

            if ($res && mysqli_num_rows($res) > 0) {
                $rec = mysqli_fetch_assoc($res);
                echo "
                <div class='product-item'>
                    <fieldset>
                        <img src='admin_img/" . htmlspecialchars($rec['pro_photo']) . "'>
                        <br>
                        <table>
                            <tr><td>Name</td><td>" . htmlspecialchars($rec['usr_Name']) . "</td></tr>
                            <tr><td>Email</td><td>" . htmlspecialchars($rec['Email']) . "</td></tr>
                            <tr><td>Address</td><td>" . htmlspecialchars($rec['Address']) . "</td></tr>
                            <tr><td>Date Of Birth</td><td>" . htmlspecialchars($rec['Date_Of_Birth']) . "</td></tr>
                            
                        </table>
                    </fieldset>
                </div>";
            } else {
                echo "<p>No user found.</p>";
            }

            mysqli_close($db);
        }
    ?>
</body>
</html>
