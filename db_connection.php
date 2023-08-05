<?php
$hostname = 'localhost'; // Often 'localhost' for local development
$database = 'warehouse';
$username = 'root';
$password = '';

// Create a connection
$conn = mysqli_connect($hostname,$username,$password,$database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>