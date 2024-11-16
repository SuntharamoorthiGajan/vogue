<?php
session_start();
$db = mysqli_connect("localhost", "root", "", "vogue");

if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

$sel_sql = "SELECT * FROM user_registration WHERE Email = ?";
$stmt = $db->prepare($sel_sql);
$stmt->bind_param("s", $_POST['txtEmail']);
$stmt->execute();
$res = $stmt->get_result();
$x = $res->num_rows;

if ($x == 0) {
    header("Location: userlogin.php");
    exit();
} else {
    $arr_tra = $res->fetch_assoc();
    if ($arr_tra['Passwords'] == md5($_POST['txtPassword'])) {
        $_SESSION['user'] = $_POST['txtEmail'];
        header("Location: userProfile.php");
        exit();
    } else {
        header("Location: userlogin.php");
        exit();
    }
}

$stmt->close();
mysqli_close($db);
?>
