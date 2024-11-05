<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Farm Connect - Home</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/navbar.css">
</head>
<body>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Fresh, Locally-Sourced Produce</h1>
            <p>Connecting local farmers directly to consumers with high-quality, fresh products.</p>
            <a href="products.php" class="btn btn-large">Shop Now</a>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section">
        <h2>About Farm Connect</h2>
        <div class="about-content">
            <p>At Farm Connect, we believe in empowering local farmers by providing them with a platform to sell their fresh produce directly to consumers. Our mission is to bridge the gap between farmers and the market, ensuring that everyone has access to fresh, locally-sourced, and sustainably-grown food. By supporting small-scale farmers, we help reduce food waste, promote eco-friendly farming practices, and foster a more sustainable food ecosystem.</p>
            <p>Whether you're a consumer looking for fresh, organic produce, or a farmer seeking to expand your reach, Farm Connect provides an easy-to-use platform where quality is guaranteed and transparency is key. Join us in creating a healthier, more connected community through the power of local agriculture.</p>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="featured-products">
        <h2>Featured Products</h2>
        <div class="product-grid">
            <div class="product-card">
                <img src="img/farm.jpg" alt="Product 1">
                <h3>Better Prices</h3>
                <p>From local farms</p>
            </div>
            <div class="product-card">
                <img src="img/organic.jpg" alt="Product 2">
                <h3>Fresh Food</h3>
                <p>Sustainably grown</p>
            </div>
            <div class="product-card">
                <img src="img/vegetables.jpg" alt="Product 3">
                <h3>Qaulity</h3>
                <p>Fresh,Clean and Tasty.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <!-- Footer / Contact Section at the Bottom of index.php -->
    <footer id="contact" class="footer" style="background-color: #4CAF50; padding: 20px; color: #fff; text-align: center;">
    <h2 style="margin-bottom: 20px;">Contact Us</h2>
    <div class="contact-info" style="margin-bottom: 15px;">
        <p style="margin-bottom: 10px;">If you have any questions, feedback, or would like to learn more about Farm Connect, feel free to get in touch with us:</p>
        <ul style="list-style-type: none; padding: 0; margin: 10px 0;">
            <li style="margin-bottom: 5px;">Email: <a href="mailto:support@farmconnect.com" style="color: #fff; text-decoration: underline;">support@farmconnect.com</a></li>
            <li style="margin-bottom: 5px;">Phone: +27 123 456 789</li>
            <li style="margin-bottom: 5px;">Address: 123 Farm Lane, Centurion, Gauteng, South Africa</li>
        </ul>
        <p style="margin-bottom: 10px;">You can also reach out to us on social media:</p>
        <ul style="list-style-type: none; padding: 0; margin: 10px 0;">
            <li style="display: inline; margin-right: 10px;"><a href="#" style="color: #fff; text-decoration: underline;">Facebook</a></li>
            <li style="display: inline; margin-right: 10px;"><a href="#" style="color: #fff; text-decoration: underline;">Instagram</a></li>
            <li style="display: inline;"><a href="#" style="color: #fff; text-decoration: underline;">Twitter</a></li>
        </ul>
    </div>
    <p style="margin: 0;">&copy; 2024 Farm Connect | Connecting Farmers with Consumers</p>
</footer>
</body>
</html>