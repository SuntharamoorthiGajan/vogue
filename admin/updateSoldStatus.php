<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
    print_r($_POST); // Check posted data
    try {
        $conn = new PDO("mysql:host=localhost;dbname=vogue", "root", "");
        $order_id = $_POST['order_id'];
        $stmt = $conn->prepare("UPDATE orders SET status = 'Delivery' WHERE order_id = :order_id");
        $stmt->bindParam(':order_id', $order_id);
        
        if ($stmt->execute()) {
            header("Location: soldDetail.php");
            exit;
        } else {
            echo "Error updating status.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
