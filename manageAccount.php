<?php
session_start();
require_once 'db_connection.php';
require_once 'functions.php';
///////////////////////////////////////////////////////////////////////////////

// Check if the user is logged in and has the 'user' role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    // User is not logged in or does not have the 'user' role
    header('Location: login.php');
    exit; // Terminate the script after the redirect
}

// Fetch user information from the database based on the user_id
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $user_data = mysqli_fetch_assoc($result);
    // You can access user data using $user_data['column_name']
} else {
    // Handle the situation when user data is not found in the database
    // For example, redirect to an error page or display an error message
    die('User data not found.');
}
///////////////////////////////////////////////////////////////////////////////


// Get the current page filename
$current_page = basename($_SERVER['PHP_SELF']);
// Define an array of widget links with their corresponding page URLs
$widget_links = [
    'Home' => 'index.php', // Set the URL to the current page
    'Manage Account' => 'manageAccount.php',
    'Track Purchases' => 'trackProduct.php',
];

// PHP code to handle form submission and update account information
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Perform the necessary logic here to update account information
    // For demonstration purposes, we'll just assume the data has been updated successfully.
    $account_updated = true;
}
///////////////////////////////////////////////////////////////////////////////
// PHP code to handle form submission and update account information
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted form data
    $new_username = $_POST['username'];
    $new_fname = $_POST['fname'];
    $new_lname = $_POST['lname'];
    $new_email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    // Additional validation (e.g., check if the new password matches the confirm password)

    // Assuming you have a column 'user_id' that uniquely identifies the user in the database
    $user_id = $_SESSION['user_id'];

    // Perform the update query to update user information in the database
    if ($new_password == $confirm_new_password){
    $update_query = "UPDATE users 
                     SET username = '$new_username', fname = '$new_fname', lname = '$new_lname', email = '$new_email', password = '$new_password' 
                     WHERE user_id = '$user_id'";
    
    // Execute the query
    if (mysqli_query($conn, $update_query)) {
        // If the update is successful, set the account_updated variable to true for showing the success message
        $account_updated = true;
        // You may also consider refreshing the user data from the database here to show the updated information in the form immediately.
        // For instance, you could re-run the SELECT query above to get the updated user_data and store it in the session.
        // $result = mysqli_query($conn, $query);
        // if ($result && mysqli_num_rows($result) > 0) {
        //    $user_data = mysqli_fetch_assoc($result);
        //    $_SESSION['username'] = $user_data['username'];
        //    // Similarly, update other session variables if needed.
        // }
    } else {
        // If the update fails, you can handle the error here
        die('Update failed: ' . mysqli_error($conn));
    }
}
else{echo "passwords dont match!";};
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
        <h1>Manage your account</h1>
        <div class="account-form">
            <h2>Manage Account</h2>
            <form method="post" action="manageAccount.php">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" value="<?php echo $user_data['username']; ?> " required>

                <label for="fname">First Name:</label>
                <input type="text" name="fname" id="fname" value="<?php echo $user_data['fname']; ?>" required>

                <label for="lname">Last Name:</label>
                <input type="text" name="lname" id="lname" value="<?php echo $user_data['lname']; ?>" required>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo $user_data['email']; ?>" required>

                <label for="new_password">New Password:</label>
                <input type="password" name="new_password" id="new_password" required>

                <label for="confirm_new_password">Confirm New Password:</label>
                <input type="password" name="confirm_new_password" id="confirm_new_password" required>

                <input type="submit" value="Save Changes">
            </form>
            <?php
            if (isset($account_updated) && $account_updated) {
                
            }
            ?>
        </div>
    </div>
</body>
</html>
