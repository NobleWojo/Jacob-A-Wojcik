<?php
// Get the current page filename
$current_page = basename($_SERVER['PHP_SELF']);

// Define an array of widget links with their corresponding page URLs
$widget_links = [
    'Home' => 'indexAdmin.php', // Set the URL to the current page
    'Manage Account' => 'ManageAccountAdmin.php',
    'Manage Product' => 'manageProduct.php',
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
        <h1>Welcome to PlaceHolder
        </h1>
        <!-- Add your main content here -->
    </div>
</body>
</html>
