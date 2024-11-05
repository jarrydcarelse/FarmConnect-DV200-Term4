<?php 
session_start();
include 'db.php';
include 'navbar.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'farmer') {
    header("Location: login.php");
    exit();
}

$farmer_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars(trim($_POST['name']));
    $description = htmlspecialchars(trim($_POST['description']));
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Insert product into the database
    $stmt = $conn->prepare("INSERT INTO products (farmer_id, name, description, price, quantity) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issdi", $farmer_id, $name, $description, $price, $quantity);

    if ($stmt->execute()) {
        $success_message = "Product added successfully.";
    } else {
        $error_message = "Error adding product: " . $stmt->error;
    }
}

// Retrieve products for the logged-in farmer
$products = $conn->query("SELECT * FROM products WHERE farmer_id = $farmer_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Farmer Dashboard</title>
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="dashboard">
        <h2>Add a New Product</h2>
        
        <?php if (isset($success_message)): ?>
            <div class="success-message"><?php echo htmlspecialchars($success_message); ?></div>
        <?php endif; ?>
        
        <?php if (isset($error_message)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <form method="POST" action="dashboard.php" class="add-product-form">
            <input type="text" name="name" placeholder="Product Name" required aria-label="Product Name">
            <textarea name="description" placeholder="Description" required aria-label="Description"></textarea>
            <input type="number" name="price" placeholder="Price" required step="0.01" aria-label="Price">
            <input type="number" name="quantity" placeholder="Quantity" required aria-label="Quantity">
            <button type="submit">Add Product</button>
        </form>

        <h3>Your Products</h3>
        <div class="products-list">
            <?php while ($product = $products->fetch_assoc()): ?>
                <div class="product-card">
                    <h4><?php echo htmlspecialchars($product['name']); ?></h4>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                    <p>Price: R<?php echo $product['price']; ?> | Stock: <?php echo $product['quantity']; ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>