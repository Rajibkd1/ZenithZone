<?php
// Start the session
// session_start();

// Include the database connection file
include "../Database_Connection/DB_Connection.php"; // Make sure the path is correct

// Retrieve and sanitize GET parameters
$userId = filter_input(INPUT_GET, 'user_id', FILTER_SANITIZE_NUMBER_INT);
$productId = filter_input(INPUT_GET, 'product_id', FILTER_SANITIZE_NUMBER_INT);
$quantity = filter_input(INPUT_GET, 'quantity', FILTER_SANITIZE_NUMBER_INT);
$totalAmount = filter_input(INPUT_GET, 'total_amount', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

// Check if the user has an existing order
$query = "SELECT order_id FROM orders WHERE customer_id = ? ORDER BY order_id DESC LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId); // Bind the user_id as an integer
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    // No existing order for the user, create a new order
    $query = "INSERT INTO orders (customer_id) VALUES (?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId); // Bind the user_id as an integer
    $stmt->execute();

    // Get the new order_id
    $orderId = $conn->insert_id;
} else {
    // Existing order found, use the existing order_id
    $stmt->bind_result($orderId);
    $stmt->fetch();
}

// Insert the order item into order_items table
$query = "INSERT INTO order_items (order_id, product_id, quantity, order_amount) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("iiid", $orderId, $productId, $quantity, $totalAmount); // Bind the parameters (order_id, product_id, quantity, total_amount)
$stmt->execute();

// Provide feedback to the user
echo "Order confirmed! Your Order ID: " . $orderId;
?>
