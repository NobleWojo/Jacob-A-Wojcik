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


?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
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
    <div id="content">
        <!-- Main content -->
        <h1>Welcome to PlaceHolder</h1>
        <!-- Add your main content here -->

        <form method="post" action="index.php"> <!-- Assuming you have a file named "process_order.php" to handle the form submission -->
            <?php
            // Assuming you have already established the database connection $conn

            // Query to retrieve data
            $query = "SELECT product_id, product_name, price, description, quantity_left FROM products";
            $result = mysqli_query($conn, $query);

            // Check if there are any rows returned
            if (mysqli_num_rows($result) > 0) {
                echo "<table border='1'>";
                echo "<tr><th>product_id</th><th>product_name</th><th>price</th><th>description</th><th>quantity_left</th><th>Enter Quantity</th></tr>";

                // Fetch data and display in table rows
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['product_id'] . "</td>";
                    echo "<td>" . $row['product_name'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['quantity_left'] . "</td>";
                
                    // Add the quantity input field
                    echo "<td><input type='number' name='quantity[" . $row['product_id'] . "]' min='0' max='" . $row['quantity_left'] . "'></td>";

                
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "No data found.";
            }
            ?>
            <input type="submit" value="Submit Order">
        </form>
    </div>
</body>
</html>
