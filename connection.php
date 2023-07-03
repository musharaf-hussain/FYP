<?php
$host = "localhost"; // replace with your host
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$database = "ams"; // replace with your database name

// Establish a connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


