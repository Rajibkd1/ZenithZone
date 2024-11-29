<?php
// Include the database connection file
include "../Database_Connection/DB_Connection.php"; // Make sure the path is correct

// Retrieve and sanitize GET parameters
$userId = filter_input(INPUT_GET, 'user_id', FILTER_SANITIZE_NUMBER_INT);
$productId = filter_input(INPUT_GET, 'product_id', FILTER_SANITIZE_NUMBER_INT);  
$quantity = filter_input(INPUT_GET, 'quantity', FILTER_SANITIZE_NUMBER_INT);
$totalAmount = filter_input(INPUT_GET, 'total_amount', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

// Check if customer (user_id) exists in the orders table
$query = "SELECT order_id FROM orders WHERE customer_id = ?";
$stmt = $conn->prepare($query);
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}
$stmt->bind_param("i", $userId); // Bind the customer_id to the query
$stmt->execute();
$result = $stmt->get_result();

// If no order found, create a new order entry
if ($result->num_rows == 0) {
    // Create a new order for this customer
    $insertOrderQuery = "INSERT INTO orders (customer_id) VALUES (?)";
    $insertStmt = $conn->prepare($insertOrderQuery);
    if ($insertStmt === false) {
        die("Error preparing order insertion statement: " . $conn->error);
    }
    $insertStmt->bind_param("i", $userId); // Bind the customer_id
    $insertStmt->execute();

    // Get the newly created order_id
    $orderId = $insertStmt->insert_id; // Get the auto-incremented order_id
} else {
    // If an order exists for the customer, retrieve the order_id
    $orderData = $result->fetch_assoc();
    $orderId = $orderData['order_id'];
}

// Check if the product already exists in the order_items table for the same timestamp
$checkProductQuery = "SELECT order_item_id FROM order_items WHERE order_id = ? AND product_id = ? AND created_at = CURRENT_TIMESTAMP";
$checkStmt = $conn->prepare($checkProductQuery);
if ($checkStmt === false) {
    die("Error preparing product existence check: " . $conn->error);
}
$checkStmt->bind_param("ii", $orderId, $productId);
$checkStmt->execute();
$productResult = $checkStmt->get_result();

// If the product doesn't exist, insert the new product as a new order_item
if ($productResult->num_rows == 0) {
    $insertOrderItemQuery = "INSERT INTO order_items (order_id, product_id, quantity, order_amount, created_at, status) 
                             VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP, 'Pending')";
    $orderItemStmt = $conn->prepare($insertOrderItemQuery);
    if ($orderItemStmt === false) {
        die("Error preparing order item insertion statement: " . $conn->error);
    }
    $orderItemStmt->bind_param("iiid", $orderId, $productId, $quantity, $totalAmount);
    $orderItemStmt->execute();
    
    // Check if the insertion was successful
    if ($orderItemStmt->affected_rows > 0) {
        echo "Order item added successfully!";
    } else {
        echo "Error adding order item: " . $conn->error;
    }
} else {
    echo "This product has already been added to the order at the same timestamp.";
}

// Close the prepared statements and database connection
$stmt->close();
if (isset($insertStmt)) {
    $insertStmt->close(); // Close only if initialized
}
$checkStmt->close();
$orderItemStmt->close();
$conn->close();
?>
