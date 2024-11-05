<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'farmer') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    // Update the order status to 'Completed'
    $stmt = $conn->prepare("UPDATE orders SET status = 'Completed' WHERE id = ?");
    $stmt->bind_param("i", $order_id);
    
    if ($stmt->execute()) {
        // Optionally notify the consumer here (e.g., send an email or notification)
        header("Location: manage_orders.php?success=1");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>