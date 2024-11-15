<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "Admin"; 

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it does not exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    // Optionally, you can use this message for debugging
    // echo "Database created successfully or already exists.";
} else {
    die("Error creating database: " . $conn->error);
}

// Select the database to use
$conn->select_db($dbname);

// Check if the database was selected successfully
if ($conn->error) {
    die("Failed to select database: " . $conn->error);
}
?>
