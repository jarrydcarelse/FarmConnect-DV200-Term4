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

// Retrieve cart items for the logged-in user
$query = "SELECT products.id, products.name, products.price, cart.quantity, (products.price * cart.quantity) AS item_total
          FROM cart
          JOIN products ON cart.product_id = products.id
          WHERE cart.user_id = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="cart.css"> <!-- Assuming the path is correct -->
</head>
<body>
    <div class="cart-container">
        <h2>Your Cart</h2>

        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="cart-item">
                    <h4><?php echo htmlspecialchars($row['name']); ?></h4>
                    <p>Price: R<?php echo number_format($row['price'], 2); ?> per kg</p>
                    <form action="update_cart.php" method="POST" class="update-form">
                        <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                        <label>Quantity:</label>
                        <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" min="1">
                        <button type="submit" class="btn-update">Update</button>
                    </form>
                    <form action="remove_from_cart.php" method="POST" class="remove-form">
                        <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="btn-remove">Remove</button>
                    </form>
                    <p>Subtotal: R<?php echo number_format($row['item_total'], 2); ?></p>
                </div>
                <?php $total += $row['item_total']; ?>
            <?php endwhile; ?>
            
            <div class="cart-total">
                <h3>Total: R<?php echo number_format($total, 2); ?></h3>
                <button onclick="placeOrder()" class="btn-checkout">Place Order</button>
            </div>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>

    <!-- JavaScript for AJAX request -->
    <script>
        function placeOrder() {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "place_order.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Show confirmation message and clear the cart view
                    alert("Order placed successfully!");
                    document.querySelector('.cart-container').innerHTML = '<p>Your cart is now empty.</p>';
                }
            };
            
            xhr.send();
        }
    </script>
   
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>