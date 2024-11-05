<?php
session_start();
include 'db.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['user_id'])) {
    exit(); // Prevent unauthorized access
}

$user_id = $_SESSION['user_id'];

// Retrieve cart items for the logged-in user
$query = "SELECT product_id, quantity FROM cart WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Insert each cart item into the orders table
    while ($row = $result->fetch_assoc()) {
        $product_id = $row['product_id'];
        $quantity = $row['quantity'];

        $insertOrderQuery = "INSERT INTO orders (user_id, product_id, quantity, order_date, status)
                             VALUES (?, ?, ?, NOW(), 'Pending')";
        $insertOrderStmt = $conn->prepare($insertOrderQuery);
        $insertOrderStmt->bind_param("iii", $user_id, $product_id, $quantity);
        $insertOrderStmt->execute();
    }

    // Clear the user's cart after placing the order
    $clearCartQuery = "DELETE FROM cart WHERE user_id = ?";
    $clearCartStmt = $conn->prepare($clearCartQuery);
    $clearCartStmt->bind_param("i", $user_id);
    $clearCartStmt->execute();
}

// Close connections
$stmt->close();
$conn->close();
exit(); // End script with no output
?>