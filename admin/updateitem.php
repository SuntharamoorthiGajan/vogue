<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id0 = $_POST['item_id'];

    // Connect to the database
    $db = mysqli_connect("localhost", "root", "", "vogue");

    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch the item details
    $sql = "SELECT * FROM dresses WHERE id = '$id0'";
    $result = mysqli_query($db, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "No record found.";
        exit();
    }

    // Close the database connection
    mysqli_close($db);
} else {
    echo "Invalid request.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Advertisement</title>
    <style>
         body {
            font-family: 'Arial', sans-serif;
            background-color: #000;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: flex-start; /* Align to left */
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            justify-content: flex-start; /* Align to left */
            align-items: flex-start;
            width: 60%; /* Adjust width as per your requirement */
            margin-left: auto;
            margin-right: auto; /* Centers the container horizontally */
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
            width: 100%;
        }

        .product-item h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #ffa500;
        }

        .form-group {
            margin-bottom: 15px;
            width: 80%;
            text-align: left;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            color: #ffa500;
        }

        .form-group input[type="text"],
        .form-group input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }

        .btn-primary {
            background-color: #008000;
            color: #fff;
            padding: 10px 20px;
            margin-top: 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #006400;
        }

        .small-images {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }

        .small-images img {
            width: 30%;
            height: 50%;
            border: 2px solid #ffa500;
            border-radius: 5px;
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
    <div class="container">
        <form action="update_process.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($row['id']); ?>">
            <div class="product-item">
                <div class="content">
                    <h2><?php echo htmlspecialchars($row['dress_name']); ?></h2>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="text" name="price" id="price" value="<?php echo htmlspecialchars($row['dress_price']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="dress_sizes">Dress Sizes:</label>
                        <input type="text" name="dress_sizes" id="dress_sizes" value="<?php echo htmlspecialchars($row['dress_sizes']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="dress_colors">Dress Colors:</label>
                        <input type="text" name="dress_colors" id="dress_colors" value="<?php echo htmlspecialchars($row['dress_colors']); ?>" required>
                    </div>
                    <div class="small-images">

                        <div>
                            <p >Current Image One:</p>
                            <img src="../admin/dress_images/<?php echo htmlspecialchars($row['image_one']); ?>" alt="Image One" >
                            
                        </div>
                        <div>
                            <p>Current Image Two:</p>
                            <img src="../admin/dress_images/<?php echo htmlspecialchars($row['image_two']); ?>" alt="Image Two" >
                            
                        </div>
                        <div>
                            <p>Current Image Three:</p>
                            <img src="../admin/dress_images/<?php echo htmlspecialchars($row['image_three']); ?>" alt="Image Three">
                            
                        </div>
                    </div>

                    <button type="submit" class="btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
