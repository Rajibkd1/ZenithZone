<?php
session_start();
// Include the database connection file
include "../Database_Connection/DB_Connection.php";

$orders = [];
$errorMsg = ''; // Variable to hold error messages

$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
if ($userId) { // Check if the user is logged in

    // Prepare and execute the query to fetch the user's orders from the orders table
    $ordersQuery = "SELECT order_id FROM orders WHERE customer_id = ?";
    if ($stmt = $conn->prepare($ordersQuery)) {
        $stmt->bind_param("i", $userId);  // Bind the user ID to the query
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Debugging line: print out the number of orders fetched
            // echo "Orders found: " . $result->num_rows . "<br>";

            // Fetch all orders for this user
            while ($order = $result->fetch_assoc()) {
                $orderId = $order['order_id'];

                // Debugging line: print out the order details
                // echo "Order ID: {$order['order_id']}<br>";

                // Fetch the items for each order from the order_items table
                $itemsQuery = "SELECT oi.order_item_id, pi.Product_name, pi.Product_image_path, oi.quantity, oi.order_amount
                               FROM order_items oi
                               JOIN product_info pi ON oi.product_id = pi.Product_id
                               WHERE oi.order_id = ?";
                if ($itemsStmt = $conn->prepare($itemsQuery)) {
                    $itemsStmt->bind_param("i", $orderId);
                    $itemsStmt->execute();
                    $itemsResult = $itemsStmt->get_result();

                    $orderItems = [];
                    if ($itemsResult->num_rows > 0) {
                        // Debugging line: print out the number of items fetched
                        // echo "Items for Order #{$order['order_id']}: " . $itemsResult->num_rows . "<br>";

                        while ($item = $itemsResult->fetch_assoc()) {
                            // Debugging line: print out the fetched item details
                            // echo "Item: " . $item['Product_name'] . "<br>";
                            $orderItems[] = $item;  // Store each item in the order
                        }
                    } else {
                        // Debugging line: no items found
                        echo "No items found for order #{$order['order_id']}<br>";
                    }
                    // Add the order and its items to the orders array
                    $orders[] = [
                        'order' => $order,
                        'items' => $orderItems
                    ];

                    $itemsStmt->close();
                } else {
                    echo "Error preparing items query: " . $conn->error;
                }
            }
        } else {
            $errorMsg = "No orders found for this user.";
        }
        $stmt->close();
    } else {
        echo "Error preparing orders query: " . $conn->error;
    }
} else {
    $errorMsg = "User ID not provided.";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .order-container {
            max-height: 500px;
            overflow-y: auto;
        }
    </style>
</head>

<body class="bg-gray-50 mt-36 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Order List -->
            <div class="flex-1 bg-white rounded-xl shadow-lg p-4">
                <h2 class="text-2xl font-bold mb-6">Your Order List</h2>

                <?php
                if (!empty($orders)) {
                    echo '<div class="order-container">';
                    foreach ($orders as $orderData) {
                        $order = $orderData['order'];
                        $items = $orderData['items'];

                        // Display the items for the order
                        if (!empty($items)) {
                            echo "<div class='mt-4'>";
                            foreach ($items as $item) {
                                echo <<<HTML
                                    <div class="flex items-center justify-between py-4 border-b">
                                        <div class="flex items-center space-x-6">
                                            <a href="../Products/Product_view.php?product_id={$item['order_item_id']}">
                                                <img src="{$item['Product_image_path']}" alt="{$item['Product_name']}" class="w-16 h-16 object-cover rounded-md shadow-sm"/>
                                            </a>

                                            <div class="flex flex-col">
                                                <a href="../Products/Product_view.php?product_id={$item['order_item_id']}">
                                                    <span class="text-lg font-medium text-gray-900">{$item['Product_name']}</span>
                                                </a>
                                                <span class="text-sm text-gray-500">Quantity: {$item['quantity']}</span>
                                                <span class="text-lg text-orange-500">৳{$item['order_amount']}</span>
                                            </div>
                                        </div>
                                    </div>
HTML;
                            }
                            echo "</div>";
                        } else {
                            echo "<p>No items found for this order.</p>";
                        }

                        echo "</div>";
                    }
                    echo '</div>';
                } else {
                    echo "<p>$errorMsg</p>";
                }
                ?>

            </div>

        </div>
    </div>
</body>

</html>
