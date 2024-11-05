<?php 
include 'navbar.php';
include 'db.php'; // Database connection file

// Fetch products from the database
$sql = "SELECT id, name, description, price FROM products";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Browse Products</title>
    <link rel="stylesheet" href="products.css">
</head>
<body>
    <div class="product-page-container">
        <h1 class="page-title">Browse Our Fresh Products</h1>
        <p class="page-subtitle">Directly from local farms to your table</p>
        
        <div class="product-grid">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '
                    <div class="product-card">
                        
                        <h3>' . $row["name"] . '</h3>
                        <p>' . $row["description"] . '</p>
                        <p class="price">R' . number_format($row["price"], 2) . ' per kg</p>
                        <button onclick="addToCart(' . $row["id"] . ')" class="btn-add-cart">Add to Cart</button>
                    </div>';
                }
            } else {
                echo "<p>No products available.</p>";
            }
            $conn->close();
            ?>
        </div>

        <!-- Feedback message -->
        <div id="cart-message" style="display:none;">Item added to cart!</div>
    </div>

    <!-- JavaScript for AJAX request -->
    <script>
        function addToCart(productId) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "add_to_cart.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Show confirmation message
                    const message = document.getElementById("cart-message");
                    message.style.display = "block";
                    setTimeout(() => {
                        message.style.display = "none";
                    }, 2000); // Hide after 2 seconds
                }
            };
            xhr.send("product_id=" + productId);
        }
    </script>
   
</body>
</html>