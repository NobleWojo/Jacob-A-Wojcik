<?php

require_once 'db_connection.php';
require_once 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract the form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email'];
    $account_type = $_POST['account_type'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $role = 'admin';

    if ($account_type == 'users') { // Corrected variable name
        $sql = "INSERT INTO $account_type (username, password, fname, lname, email, address) VALUES ('$username', '$password', '$fname', '$lname', '$email', '$address')";
    } else if ($account_type == 'employees') { // Corrected variable name
        $sql = "INSERT INTO $account_type (username, password, fname, lname, email, role) VALUES ('$username', '$password', '$fname', '$lname', '$email', '$role')"; // Added missing quote
    }

    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    header("Location: login.php");
    die;
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Create Account</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #333;
        }

        .create-account-container {
            text-align: center;
            padding: 40px;
            border: 2px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
        }

        .create-account-container label,
        .create-account-container input {
            display: block;
            margin-bottom: 10px;
        }

        .create-account-container input[type="submit"] {
            margin-top: 10px;
        }

        .account-type {
            margin-bottom: 10px;
        }

        .account-type input[type="radio"] {
            display: none;
        }

        .account-type label {
            display: inline-block;
            padding: 8px 16px;
            font-size: 16px;
            border: 1px solid #ccc;
            background-color: #f2f2f2;
            cursor: pointer;
        }

        .account-type input[type="radio"]:checked + label {
            background-color: lightblue;
        }
    </style>
</head>
<body>
    <div class="create-account-container">
        <h2>Create Account</h2>
        <form method="post" action="createAccount.php">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required><br>
            
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br>
            
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" required><br>

            <label for="fname">First Name:</label>
            <input type="fname" name="fname" id="fname" required><br>

            <label for="lname">Last Name:</label>
            <input type="lname" name="lname" id="lname" required><br>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required><br>

            <label for="address">Address:</label>
            <input type="address" name="address" id="address" required><br>

            <div class="account-type">
                <input type="radio" name="account_type" id="login_user" value="users" checked>
                <label for="login_user">User</label>
            </div>
            
            <div class="account-type">
                <input type="radio" name="account_type" id="login_employee" value="employees">
                <label for="login_employee">Employee</label>
            </div><br><br>
                     
            <input type="submit" value="Create Account">
        </form>

        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
