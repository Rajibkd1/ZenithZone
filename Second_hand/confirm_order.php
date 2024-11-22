<?php
// Start the session
session_start();

// Retrieve and sanitize GET parameters
$userId = filter_input(INPUT_GET, 'user_id', FILTER_SANITIZE_NUMBER_INT);
$productId = filter_input(INPUT_GET, 'product_id', FILTER_SANITIZE_NUMBER_INT);
$userType = filter_input(INPUT_GET, 'user_type', FILTER_SANITIZE_STRING); // Retrieve and sanitize user type

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Order Confirmation</h1>
    <p>User ID: <?= htmlspecialchars($userId); ?></p>
    <p>Product ID: <?= htmlspecialchars($productId); ?></p>
    <p>User Type: <?= htmlspecialchars($userType); ?></p> <!-- Display the user type -->
</body>
</html>
