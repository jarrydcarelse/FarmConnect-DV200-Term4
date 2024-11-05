<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

// Update quantity in the cart
$query = "UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("iii", $quantity, $user_id, $product_id);
$stmt->execute();

header("Location: cart.php");
exit();
?>