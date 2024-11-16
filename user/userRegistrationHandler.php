<?php
$db=mysqli_connect("localhost","root","","vogue");
$image_details = pathinfo($_FILES['imageFile']['name']);
$new_image_name = "img_" . $_POST['txtName'] . ".jpg";
move_uploaded_file($_FILES['imageFile']['tmp_name'], "user_images/" . $new_image_name);
$in_sql="INSERT INTO user_registration (Email, usr_Name, Passwords, Con_Number, Date_Of_Birth, Address,  pro_photo 	) VALUES ('".$_POST['txtEmail']."','".$_POST['txtName']."','".md5($_POST['txtPassword'])."',".$_POST['txtContactNo'].",'".$_POST['txtdate']."','".$_POST['txtaddress']."','". $new_image_name ."')";
mysqli_query($db,$in_sql);
mysqli_close($db);
header("Location:userlogin.php");
?>

