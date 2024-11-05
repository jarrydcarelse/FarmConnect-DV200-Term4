<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="css/your_stylesheet.css"> <!-- Include your CSS file here -->
</head>
<body>
    <h1>Add New Product</h1>
    <form action="add-product.php" method="POST" enctype="multipart/form-data">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" id="product_name" required><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea><br>

        <label for="price">Price:</label>
        <input type="number" step="0.01" name="price" id="price" required><br>

        <label for="category">Category:</label>
        <input type="text" name="category" id="category" required><br>

        <label for="image">Product Image:</label>
        <input type="file" name="image" id="image" accept="image/*" required><br><br>

        <button type="submit" name="submit">Add Product</button>
    </form>

    <?php
    // Connect to the database
    include 'config.php';

    if (isset($_POST['submit'])) {
        $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);

        // Handle image upload
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true); // Ensure the uploads directory exists
        }

        $image_name = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image_name;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is an actual image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if the file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Limit file size to 5MB
        if ($_FILES["image"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow only JPG, JPEG, PNG, and GIF file formats
        if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if everything is okay to proceed with the upload
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Insert product details into the database
                $sql = "INSERT INTO products (product_name, description, price, category, image)
                        VALUES ('$product_name', '$description', '$price', '$category', '$image_name')";

                if (mysqli_query($conn, $sql)) {
                    echo "The product has been added successfully.";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Close the connection
    mysqli_close($conn);
    ?>
</body>
</html>