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
        .search-filter-container {
            margin-top: 100px; 
            border: 2px solid #ffa500;
            margin-left: 20px;
            margin-right: 20px;
            border-radius: 10px;
            background-color: #000;
        }

        .search-filter-container input{
            width: 85%;
            border: 2px solid #ffa500;
        }
        .search-filter-container select{
            width: 10%;
            border: 2px solid #ffa500;
        }

        .search-filter-container input[type="text"],
        .search-filter-container select {
            
            padding: 10px;
            margin: 10px;
            font-size: 16px;
        }

        .search-filter-container button {
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
<div class="search-filter-container">
    <form method="GET" action="soldDetail.php">
        <input type="text" name="search" placeholder="Search by User ID..." value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
        <button type="submit">Search</button>
    </form>
</div>

<table class="cart-table">
    <thead>
        <tr>
            <th scope="col">Dress ID</th>
            <th scope="col">User ID</th>
            <th scope="col">Dress Size</th>
            <th scope="col">Dress Colors</th>
            <th scope="col">Total price</th>
            <th scope="col"> Quantity</th>
            <th scope="col">Delivery Address</th>
            <th scope="col">Phone Number</th>
            <th scope="col">Status</th>
            <th scope="col">Edit</th>
        </tr>
    </thead>
    <tbody>
        
    <?php 
        try {
            $db = mysqli_connect("localhost", "root", "", "vogue");

            $query = "SELECT * FROM orders WHERE 1=1";
            
            
            $search = $_GET['search'] ?? '';

            
            if (!empty($search)) {
                $query .= " AND user_id LIKE '%" . mysqli_real_escape_string($db, $search) . "%'";
            }

            $res = mysqli_query($db, $query);

            if ($res && mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
        ?>
            <tr>
                <td><?php echo htmlspecialchars($row['dress_id']); ?></td>
                <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                <td><?php echo htmlspecialchars($row['size']); ?></td>
                <td><?php echo htmlspecialchars($row['color']); ?></td>
                <td>Rs.<?php echo htmlspecialchars($row['total_price']); ?></td>
                <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                <td><?php echo htmlspecialchars($row['delivery_address']); ?></td>
                <td><?php echo htmlspecialchars($row['phone_number']); ?></td>
                <td style="color: <?php echo ($row['status'] === 'Delivery') ? 'green' : 'while'; ?>"><?php echo htmlspecialchars($row['status']); ?></td>
                <td>
                    <div class="d-flex">
                        <?php if ($row['status'] === 'New order'): ?>
                            <form action="updateSoldStatus.php" method="post" style="display: inline;">
                                <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($row['order_id']); ?>">
                                <input type="hidden" name="update_status" value="1"> <!-- Add this line -->
                                <button style="background-color:#008000; margin-top: 5px;" type="submit">Update</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </td>
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
