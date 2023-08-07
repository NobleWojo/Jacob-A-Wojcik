<?php
session_start();
require_once 'db_connection.php';
require_once 'functions.php';

// Check if the product_id is provided in the URL
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Query to retrieve data for the specific product_id
    $query = "SELECT product_id, product_name, price, description, quantity_left FROM products WHERE product_id = $product_id";
    $result = mysqli_query($conn, $query);

    // Check if the product_id exists in the database
    if (mysqli_num_rows($result) === 1) {
        // Fetch the data for the specific product_id
        $row = mysqli_fetch_assoc($result);
    } else {
        // Handle the case where the product_id is not found
        echo "Product not found.";
        exit;
    }
} else {
    // Handle the case where the product_id is not provided in the URL
    echo "Invalid product ID.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <style>
        /* Add CSS here */
    </style>
</head>
<body>
    <h1>Edit Product: <?php echo $row['product_name']; ?></h1>
    <form method="post" action="process_edit_product.php">
        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
        Product Name: <input type="text" name="product_name" value="<?php echo $row['product_name']; ?>"><br>
        Price: <input type="number" name="price" value="<?php echo $row['price']; ?>"><br>
        Description: <textarea name="description"><?php echo $row['description']; ?></textarea><br>
        Quantity Left: <input type="number" name="quantity_left" value="<?php echo $row['quantity_left']; ?>"><br>
        <input type="submit" value="Save Changes">
    </form>
</body>
</html>