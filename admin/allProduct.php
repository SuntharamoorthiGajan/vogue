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
            width: 75%;
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
    <form method="GET" action="allProduct.php">
        <input type="text" name="search" placeholder="Search by dress name..." value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
        <button type="submit">Search</button>
        <select name="gender" onchange="this.form.submit()">
            <option value="">All</option>
            <option value="Women" <?php if (isset($_GET['gender']) && $_GET['gender'] == 'Women') echo 'selected'; ?>>Women</option>
            <option value="Men" <?php if (isset($_GET['gender']) && $_GET['gender'] == 'Men') echo 'selected'; ?>>Men</option>
            <option value="Children" <?php if (isset($_GET['gender']) && $_GET['gender'] == 'Children') echo 'selected'; ?>>Children</option>
        </select>
    </form>
</div>

<table class="cart-table">
    <thead>
        <tr>
            <th scope="col">Dress Type</th>
            <th scope="col">Dress name</th>
            <th scope="col">Company Name</th>
            <th scope="col">Dress price</th>
            <th scope="col">Dress Size</th>
            <th scope="col">Dress Colors</th>
            <th scope="col">Gender</th>
            <th scope="col">Image</th>
            <th scope="col">Edit</th>
        </tr>
    </thead>
    <tbody>
        
    <?php 
        try {
            $db = mysqli_connect("localhost", "root", "", "vogue");

            $query = "SELECT * FROM dresses WHERE 1=1";
            
            $gender = $_GET['gender'] ?? '';
            $search = $_GET['search'] ?? '';

            if (!empty($gender)) {
                $query .= " AND gender = '" . mysqli_real_escape_string($db, $gender) . "'";
            }
            if (!empty($search)) {
                $query .= " AND dress_name LIKE '%" . mysqli_real_escape_string($db, $search) . "%'";
            }

            $res = mysqli_query($db, $query);

            if ($res && mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
        ?>
            <tr>
                <td><?php echo htmlspecialchars($row['dress_type']); ?></td>
                <td><?php echo htmlspecialchars($row['dress_name']); ?></td>
                <td><?php echo htmlspecialchars($row['company_name']); ?></td>
                <td>Rs.<?php echo htmlspecialchars($row['dress_price']); ?></td>
                <td><?php echo htmlspecialchars($row['dress_sizes']); ?></td>
                <td><?php echo htmlspecialchars($row['dress_colors']); ?></td>
                <td><?php echo htmlspecialchars($row['gender']); ?></td>
                <td><img src="../admin/dress_images/<?php echo htmlspecialchars($row['image_one']); ?>" style="width:50px; height:50px;"></td>
                <td>
                    <div class="d-flex">
                        <form action="item_delete.php" method="post" style="display: inline;">
                            <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                            <button style="background-color:#f00c0c;" type="submit">Delete</button>
                        </form>
                        <form action="updateitem.php" method="post" style="display: inline;">
                            <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                            <button style="background-color:#008000; margin-top: 5px;" type="submit">Update</button>
                        </form>
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
