<?php
session_start(); // Start the session

// Check if there is a 'logout' action in the URL query string
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    // Unset all session variables
    $_SESSION = [];

    // Destroy the session completely
    session_destroy();

    // Redirect to the login page or homepage
    header("Location: ./Login.php");
    exit();
}

// Check if the user is logged in by verifying the session variable
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // If the user is not logged in, redirect them to the login page
    header("Location: ./Login.php");
    exit();
}
?>
