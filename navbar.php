<?php session_start(); ?>
<link rel="stylesheet" href="css/navbar.css">
<header>
    <nav>
        <!-- Left Logo and Site Name -->
        <div class="logo">
            <a href="index.php">
                <img src="img/logo.png" alt="Farm Connect Logo" class="logo-img">
                <span class="site-name">Farm Connect</span>
            </a>
        </div>

        <!-- Centered Navigation Links -->
        <ul class="nav-links">
    <li><a href="index.php">Home</a></li>
    <li><a href="products.php">Browse Products</a></li>
    <li><a href="contact.php">Contact Us</a></li> <!-- Changed to contact.php -->
    <?php if (isset($_SESSION['user_id'])): ?>
        <?php if ($_SESSION['role'] == 'farmer'): ?>
            <li><a href="dashboard.php">My Dashboard</a></li>
            <li><a href="manage_orders.php">Manage Orders</a></li>
        <?php else: ?>
            <li><a href="orders.php">My Orders</a></li>
        <?php endif; ?>
    <?php endif; ?>
</ul>

        <!-- Right-Aligned Auth Links -->
        <div class="auth-links">
            <?php if (isset($_SESSION['user_id'])): ?>
                <?php if ($_SESSION['role'] == 'consumer'): ?>
                    <a href="cart.php" class="cart-link">
                        <img src="img/cart-icon.png" alt="Cart" class="cart-icon"> 
                    </a>
                <?php endif; ?>
                <a href="logout.php" class="btn btn-logout">Logout</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-login">Login</a>
                <a href="register.php" class="btn btn-register">Register</a>
            <?php endif; ?>
        </div>
    </nav>
</header>