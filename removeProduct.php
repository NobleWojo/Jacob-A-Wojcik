<?php
session_start();
require_once 'db_connection.php';
require_once 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you have already established the database connection $conn

    $product_id = $_POST['product_id'];

    // Delete the product from the database
    $query = "DELETE FROM products WHERE product_id = $product_id";

    if (mysqli_query($conn, $query)) {
        // Product removed successfully
        header('Location: manageProduct.php');
        exit;
    } else {
        // Handle the case where the deletion failed
        echo "Failed to remove product. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Remove Product</title>
    <style>
        /* Add your custom CSS for the remove page */
    </style>
</head>
<body>
    <h1>Remove Product</h1>
    <!-- Create a form here with a dropdown to select the product to be removed -->
    <form method="post" action="removeProduct.php">
        <?php
        // Assuming you have already established the database connection $conn

        // Query to retrieve product IDs and names
        $query = "SELECT product_id, product_name FROM products";
        $result = mysqli_query($conn, $query);

        // Check if there are any rows returned
        if (mysqli_num_rows($result) > 0) {
            echo "Select a product to remove: ";
            echo "<select name='product_id'>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['product_id'] . "'>" . $row['product_name'] . "</option>";
            }
            echo "</select>";
            echo "<input type='submit' value='Remove Product'>";
        } else {
            echo "No products found.";
        }
        ?>
    </form>
</body>
</html>
