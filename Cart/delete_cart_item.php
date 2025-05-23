<?php

include '../Database_Connection/DB_Connection.php';


// Check if the cart_item_id is present
if (!isset($_POST['cart_item_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'No cart item specified']);
    exit;
}

$cart_item_id = intval($_POST['cart_item_id']);

// Prepare the SQL statement to avoid SQL injection
if ($stmt = $conn->prepare("DELETE FROM cart_items WHERE cart_item_id = ?")) {
    $stmt->bind_param("i", $cart_item_id);
    
    // Execute the query
    if ($stmt->execute()) {
        // Check if any rows were affected
        if ($stmt->affected_rows > 0) {
            // echo json_encode(['status' => 'success', 'message' => 'Item deleted successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Item not found or already deleted']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete item']);
    }
    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $conn->error]);
}

$conn->close();
?>
