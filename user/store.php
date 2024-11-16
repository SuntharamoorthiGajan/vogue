<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>VOGUE - Home</title>
<style>
    
    body {
        font-family: 'Arial', sans-serif;
        background-color: #000;
        margin: 0;
        padding: 0;
    }

    .container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around; /* Center items with equal spacing */
        margin-top: 50px; /* Adjust based on your navbar height and form */
    }

    .product-item {
        display: flex;
        background-color: #fff;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
        border: 3px solid #ffa500;
        padding: 20px;
        margin: 20px;
        border-radius: 10px;
        width: calc(30% - 40px); /* Adjust width to fit content and spacing */
        text-align: left; /* Align text to the left */
        cursor: pointer;
        transition: transform 0.3s;
    }

    .product-item:hover {
        transform: scale(1.05);
    }

    .image-container {
        flex: 1; /* Take up as much space as needed */
        margin-right: 20px; /* Space between image and content */
    }

    .image-container img {
        width: 100%; /* Image should fill its container */
        height: 200px;
        border-radius: 10px;
        border: 3px solid #ffa500;
    }

    .content {
        flex: 2; /* Take up more space */
    }

    .content h2 {
        font-size: 20px; /* Adjust font size as needed */
        font-weight: bold; /* Ensure text is bold */
        margin-bottom: 10px; /* Adjust spacing */
        color: #000;
    }

    .content p {
        font-size: 16px; /* Adjust font size as needed */
        margin-bottom: 5px; /* Adjust spacing */
        color: #000;
    }

    .search-filter-container {
        
        
        margin-top: 100px; /* Adjust based on your navbar height */
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
    <div class="search-filter-container">
        <form method="GET" action="store.php">
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
    <div class="container">
        <?php
        $db = mysqli_connect("localhost", "root", "", "vogue");

        if (!$db) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $search = isset($_GET['search']) ? mysqli_real_escape_string($db, $_GET['search']) : '';
        $gender = isset($_GET['gender']) ? mysqli_real_escape_string($db, $_GET['gender']) : '';

        $sql = "SELECT * FROM dresses WHERE 1";
        
        if (!empty($gender)) {
            if (!empty($search)) {
                $sql .= " AND dress_name LIKE '%$search%' AND gender = '$gender'";
            } else {
                $sql .= " AND gender = '$gender'";
            }    
        } elseif (!empty($search)) {
            $sql .= " AND dress_name LIKE '%$search%'";
        }

        $res = mysqli_query($db, $sql);

        if ($res && mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                echo "
                <div class='product-item' onclick='location.href=\"productsview.php?dress_id=" . $row['id'] . "\"'>
                    <div class='image-container'>
                        <img src='../admin/dress_images/" . htmlspecialchars($row['image_one']) . "' alt='" . htmlspecialchars($row['dress_name']) . "'>
                    </div>
                    <div class='content'>
                        <h2>" . htmlspecialchars($row['dress_name']) . "</h2>
                        <p>Gender: " . htmlspecialchars($row['gender']) . "</p>
                        <p>Price: Rs " . htmlspecialchars($row['dress_price']) . "</p>
                    </div>
                </div>";
            }
        } else {
            echo "<p>No dresses found.</p>";
        }

        mysqli_close($db);
        ?>
    </div>
</body>
</html>
