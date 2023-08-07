<?php
session_start();
require_once 'db_connection.php';
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize the input fields (you can add more validation as needed)

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $quantity_left = $_POST['quantity_left'];

    // Assuming you have already established the database connection $conn

    // Update the product details in the database
    $query = "UPDATE products SET product_name = '$product_name', price = $price, description = '$description', quantity_left = $quantity_left WHERE product_id = $product_id";

    if (mysqli_query($conn, $query)) {
        // Product updated successfully
        header('Location: manageProduct.php');
        exit;
    } else {
        // Handle the case where the update failed
        echo "Failed to update product. Please try again.";
    }
}
?>
