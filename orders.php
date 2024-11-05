<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'navbar.php';
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Query to retrieve orders for the logged-in user
$query = "SELECT orders.id AS order_id, products.name AS product_name, orders.quantity, 
          (orders.quantity * products.price) AS total_price, orders.status, orders.order_date
          FROM orders
          JOIN products ON orders.product_id = products.id
          WHERE orders.user_id = ?
          ORDER BY orders.order_date DESC";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Orders</title>
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="orders.css">
</head>
<body>
    <div class="order-history">
        <h2>Your Orders</h2>

        <?php if ($result->num_rows > 0): ?>
            <?php while ($order = $result->fetch_assoc()): ?>
                <div class="order-item">
                    <h4>Order ID: <?php echo htmlspecialchars($order['order_id']); ?></h4>
                    <p>Product: <?php echo htmlspecialchars($order['product_name']); ?></p>
                    <p>Quantity: <?php echo htmlspecialchars($order['quantity']); ?></p>
                    <p>Total Price: R<?php echo number_format($order['total_price'], 2); ?></p>
                    <p>Status: <?php echo htmlspecialchars($order['status']); ?></p>
                    <p>Order Date: <?php echo htmlspecialchars($order['order_date']); ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>You have no orders yet.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>