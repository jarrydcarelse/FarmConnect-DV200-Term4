<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "error: not_logged_in"; // Error if user is not logged in
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];

// Check if the product is already in the cart
$query = "SELECT * FROM cart WHERE user_id = ? AND product_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $user_id, $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Update quantity if product is already in the cart
    $query = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $user_id, $product_id);
} else {
    // Insert new product if not in the cart
    $query = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $user_id, $product_id);
}

$stmt->execute();
echo "success"; // Send success response
exit();
?>