<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="contact.css"> <!-- Link to your CSS file -->
    <style>
        /* Add any additional styling for the confirmation message here */
        .confirmation-message {
            display: none;
            padding: 10px;
            background-color: #4CAF50; /* Green background */
            color: white;
            text-align: center;
            margin-top: 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="contact-container">
        <h2>Contact Us</h2>
        <p>If you have any questions, feedback, or would like to learn more about Farm Connect, feel free to get in touch with us:</p>
        <form id="contactForm" method="POST">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
            <button type="submit">Send Message</button>
        </form>
        <div class="contact-info">
            <p>Phone: +27 123 456 789</p>
            <p>Email: <a href="mailto:support@farmconnect.com">support@farmconnect.com</a></p>
            <p>Address: 123 Farm Lane, Centurion, Gauteng, South Africa</p>
        </div>

        <!-- Confirmation Message -->
        <div id="confirmationMessage" class="confirmation-message">Your message has been sent!</div>
    </div>

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

    <script>
        document.getElementById('contactForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Display the confirmation message
            var confirmationMessage = document.getElementById('confirmationMessage');
            confirmationMessage.style.display = 'block';

            // Hide the confirmation message after 3 seconds
            setTimeout(function() {
                confirmationMessage.style.display = 'none';
            }, 3000); // 3000 milliseconds = 3 seconds

            // Optionally, you can send the form data using AJAX here
            // For now, this just prevents the page from refreshing
        });
    </script>
</body>
</html>