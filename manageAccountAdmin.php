<?php
// Get the current page filename
$current_page = basename($_SERVER['PHP_SELF']);

// Define an array of widget links with their corresponding page URLs
$widget_links = [
    'Home' => 'indexAdmin.php', // Set the URL to the current page
    'Manage Account' => 'manageAccountAdmin.php',
    'Manage Product' => 'manageProduct.php',
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
    <title>Manage Account</title>
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
    <div id="content">
        <!-- Main content -->
        <h1>Welcome to the Dashboard</h1>
        <div class="account-form">
            <h2>Manage Account</h2>
            <form method="post" action="manageAccount.php">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" value="current_username" required>

                <label for="fname">First Name:</label>
                <input type="text" name="fname" id="fname" value="current_firstname" required>

                <label for="lname">Last Name:</label>
                <input type="text" name="lname" id="lname" value="current_lastname" required>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="current_email@example.com" required>

                <label for="new_password">New Password:</label>
                <input type="password" name="new_password" id="new_password" required>

                <label for="confirm_new_password">Confirm New Password:</label>
                <input type="password" name="confirm_new_password" id="confirm_new_password" required>

                <input type="submit" value="Save Changes">
            </form>
            <?php
            if (isset($account_updated) && $account_updated) {
                echo '<p>Account information updated successfully!</p>';
            }
            ?>
        </div>
    </div>
</body>
</html>
