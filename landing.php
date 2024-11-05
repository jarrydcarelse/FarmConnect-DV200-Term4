<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Farm Connect</title>
    <link rel="stylesheet" href="css/landing.css"> <!-- Link to your CSS file -->
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column; /* Stack logo and header vertically */
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #fff; /* White background */
            overflow: hidden; /* Prevent scrolling */
        }

        .logo {
            width: 200px; /* Adjust size of logo */
            animation: spin 2s linear infinite; /* Spin animation */
            margin-bottom: 10px; /* Space between logo and text */
        }

        .header {
            font-size: 24px; /* Header font size */
            color: #4CAF50; /* Green color for the header */
            text-align: center; /* Center align the text */
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>
<body>

    <img src="img/logo.png" alt="Farm Connect Logo" class="logo"> <!-- Path to your logo -->
    <div class="header">Farm Connect</div> <!-- Header text below logo -->

    <script>
        // Redirect to index.php after 3 seconds
        setTimeout(function() {
            window.location.href = "index.php";
        }, 4000); // 3000 milliseconds = 3 seconds
    </script>
</body>
</html>