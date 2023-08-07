<?php
session_start();
require_once 'db_connection.php';
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate the input fields

    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $quantity_left = $_POST['quantity_left'];

    // Insert the new product details into the database
    $query = "INSERT INTO products (product_name, price, description, quantity_left) VALUES ('$product_name', $price, '$description', $quantity_left)";

    if (mysqli_query($conn, $query)) {
        // Product added successfully
        header('Location: manageProduct.php');
        exit;
    } else {
        // Handle the case where the insert failed
        echo "Failed to add product. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <style>
        /* CSS to be added */
    </style>
</head>
<body>
    <h1>Add Product</h1>
    <!-- Create a form here with the fields for adding a new product -->
    <form method="post" action="addProduct.php">
        Product Name: <input type="text" name="product_name"><br>
        Price: <input type="number" name="price" step="0.01"><br> <!--step="0.01" to allow decimal values-->
        Description: <textarea name="description"></textarea><br>
        Quantity Left: <input type="number" name="quantity_left"><br>
        <input type="submit" value="Add Product">
    </form>
</body>
</html>
