<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
    $role = htmlspecialchars(trim($_POST['role']));

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $role);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit(); // Stop further execution
    } else {
        echo "Registration failed: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div class="register-container">
       <h1>Farm Connect</h1>
        <h2>Create an Account</h2>
        <form action="register.php" method="POST">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="role" required>
                <option value="" disabled selected>Select Role</option>
                <option value="farmer">Farmer</option>
                <option value="consumer">Consumer</option>
            </select>
            <button type="submit">Register</button>
        </form>
        <a href="index.php" class="home-button">Home</a>
    </div>
</body>
</html>