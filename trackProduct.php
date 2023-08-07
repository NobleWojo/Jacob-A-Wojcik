<?php
session_start();
require_once 'db_connection.php';
require_once 'functions.php';
// Get the current page filename
$current_page = basename($_SERVER['PHP_SELF']);

// Define an array of widget links with their corresponding page URLs
$widget_links = [
    'Home' => 'index.php', // Set the URL to the current page
    'Manage Account' => 'manageAccount.php',
    'Track Purchases' => 'trackProduct.php',
    'Logout' => 'login.php',
];

// PHP code to handle form submission and update account information
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Perform the necessary logic here to update account information
    // For demonstration purposes, we'll just assume the data has been updated successfully.
    $account_updated = true;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Track Purchases</title>
    <style>
        /* Basic styling for the index page */
        body {
            font-family: Arial, sans-serif;
        }
        #sidebar {
            width: 200px;
            background-color: #f0f0f0;
            float: left;
            padding: 10px;
        }
        #content {
            margin-left: 220px; /* Make room for the sidebar */
            padding: 10px;
        }
        .widget {
            margin-bottom: 10px;
        }
        .widget a {
            display: block;
            padding: 5px;
            text-decoration: none;
            color: #333;
        }
        .widget a:hover {
            background-color: #ddd;
        }
        /* Style the active widget */
        .widget a.active {
            background-color: #007bff;
            color: #fff;
        }
        /* Form styling */
        .account-form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 2px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
        }
        .account-form label,
        .account-form input {
            display: block;
            margin-bottom: 10px;
        }
        .account-form input[type="submit"] {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    
    <div id="sidebar">
        <!-- Widgets -->
        <?php foreach ($widget_links as $widget => $url): ?>
            <div class="widget">
                <a href="<?php echo $url; ?>" <?php if ($current_page === $url) echo 'class="active"'; ?>><?php echo $widget; ?></a>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
// Assuming you have already established the database connection $conn

// Query to retrieve data
$query = "SELECT p.purchase_id, p.user_id, p.product_id, p.quantity, pr.product_name, pr.description 
FROM purchases p
INNER JOIN products pr ON p.product_id = pr.product_id";

$result = mysqli_query($conn, $query);
// Check if there are any rows returned
if (mysqli_num_rows($result) > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Purchases_id</th><th>Product</th><th>description</th><th>Quantity</th></tr>";

    // Fetch data and display in table rows
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['purchase_id'] . "</td>";
        echo "<td>" . $row['product_name'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td>" . $row['quantity'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No data found.";
}
?>
</body>
</html>
