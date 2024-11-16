<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = mysqli_connect("localhost", "root", "", "vogue");

    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Sanitize and validate input
    $dressType = mysqli_real_escape_string($db, $_POST['DressType']);
    $dressName = mysqli_real_escape_string($db, $_POST['DressName']);
    $companyName = mysqli_real_escape_string($db, $_POST['txtcom_name']);
    $dressPrice = floatval($_POST['DressPrice']);
    $dressSize = mysqli_real_escape_string($db, $_POST['DressSize']);
    $dressColors = mysqli_real_escape_string($db, $_POST['DressColors']);
    $gender = mysqli_real_escape_string($db, $_POST['gender']); // Add gender input

    // Process images
    $imageFields = ['imageOne', 'imageTwo', 'imageThree'];
    $imageNames = [];

    foreach ($imageFields as $imageField) {
        if (isset($_FILES[$imageField]) && $_FILES[$imageField]['error'] == UPLOAD_ERR_OK) {
            $image_details = pathinfo($_FILES[$imageField]['name']);
            $new_image_name = uniqid("img_", true) . "." . $image_details['extension'];
            if (move_uploaded_file($_FILES[$imageField]['tmp_name'], "dress_images/" . $new_image_name)) {
                $imageNames[$imageField] = $new_image_name;
            } else {
                $imageNames[$imageField] = null; // Handle file upload failure
            }
        } else {
            $imageNames[$imageField] = null; // Handle file upload failure
        }
    }

    // Insert data into database
    $sql = "INSERT INTO dresses (dress_type, dress_name, image_one, image_two, image_three, company_name, dress_price, dress_sizes, dress_colors, gender) 
            VALUES ('$dressType', '$dressName', '{$imageNames['imageOne']}', '{$imageNames['imageTwo']}', '{$imageNames['imageThree']}', '$companyName', $dressPrice, '$dressSize', '$dressColors', '$gender')";

    if (mysqli_query($db, $sql)) {
        header("Location: allproduct.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
    }

    mysqli_close($db);
}
?>
