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

if ($result->num_rows == 0) {
    $insertOrderQuery = "INSERT INTO orders (customer_id) VALUES (?)";
    $insertStmt = $conn->prepare($insertOrderQuery);
    if ($insertStmt === false) {
        die("Error preparing order insertion statement: " . $conn->error);
    }
    $insertStmt->bind_param("i", $userId); // Bind the customer_id
    $insertStmt->execute();

    $orderId = $insertStmt->insert_id; 
} else {
    $orderData = $result->fetch_assoc();
    $orderId = $orderData['order_id'];
}

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
    
    // Set the message in the session
    if ($orderItemStmt->affected_rows > 0) {
        $_SESSION['message'] = "Your Order has been place successfully!";
        $showModal = true;
    } else {
        $_SESSION['message'] = "Error adding order item: " . $conn->error;
        $showModal = true;
    }
} else {
    $_SESSION['message'] = "This product has already been added to the order at the same timestamp.";
    $showModal = true;
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZenithZone - eCommerce Website</title>
    <link rel="icon" href="../assets/images/logo/ZenithZone.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <!-- Modal HTML -->
<?php if (isset($showModal) && $showModal): ?>
<div id="messageModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-5 shadow text-center">
        <!-- Success Icon -->
        <i class="fa-solid fa-circle-check fa-5x" style="color: #3feeba;"></i>
        <!-- Success Message -->
        <p id="modalMessage" class="mt-4 text-xl font-semibold"><?php echo $_SESSION['message']; ?></p>
        <!-- Close Button -->
        <button onclick="hideModal()" class="mt-4 bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600">Close</button>
    </div>
</div>
<?php endif; ?>

    <script>
        function hideModal() {
            // Hide the modal
            document.getElementById('messageModal').style.display = 'none';
            // Redirect to the parent page (you can customize the URL)
            window.location.href = document.referrer;
        }
    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
