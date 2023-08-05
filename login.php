<?php
session_start();
require_once 'db_connection.php';
require_once 'functions.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted username, password, and login option
    $username = $_POST['username'];
    $password = $_POST['password'];
    $loginAs = $_POST['login_as'];

    // Perform your login validation logic here
    // For example, you could check against a database of users

    // Assuming you have a database table called "users" and a column "role" that indicates the user's role
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $role = $row['role'];

        if ($loginAs === 'users') {
        $_SESSION['user_id'] = $row['user_id']; // Assuming user_id is the primary key of the 'users' table
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'user';
            // Redirect to index.php for successful user login
            header('Location: index.php');

            exit; // Terminate the script after the redirect
        } elseif ($loginAs === 'employees' && $role === 'employee') {
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'employee';
            // Redirect to indexAdmin.php for successful employee login
            header('Location: indexAdmin.php');
            exit; // Terminate the script after the redirect
        }
    }

    // Invalid credentials
    echo 'Invalid username or password';
}
?>




<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #333;
        }

        .login-container {
            text-align: center;
            padding: 40px;
            border: 2px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
        }

        .login-option {
            display: inline-block;
            margin-right: 10px;
        }

        .login-option input[type="radio"] {
            display: none;
        }

        .login-option label {
            display: inline-block;
            padding: 8px 16px;
            font-size: 16px;
            border: 1px solid #ccc;
            background-color: #f2f2f2;
            cursor: pointer;
        }

        .login-option input[type="radio"]:checked + label {
            background-color: lightblue;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="post" action="login.php">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required><br><br>
            
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br><br>
            
            <div class="login-option">
                <input type="radio" name="login_as" id="login_user" value="users" checked>
                <label for="login_user">User</label>
            </div>
            
            <div class="login-option">
                <input type="radio" name="login_as" id="login_employee" value="employees">
                <label for="login_employee">Employee</label>
            </div><br><br>
            
            <input type="submit" value="Login">
        </form>

        <p>Don't have an account? <a href="createAccount.php">Create a new account</a></p>
    </div>


</body>
</html>

