<?php
session_start();
include "../Database_Connection/DB_Connection.php";

$errorMsg = '';
$successMsg = '';

// Get the order_item_id from the query string
$orderItemId = isset($_GET['order_item_id']) ? $_GET['order_item_id'] : null;

if ($orderItemId) {
    // Retrieve order details based on order_item_id
    $orderQuery = "SELECT oi.order_id, oi.product_id, o.customer_id
                   FROM order_items oi
                   JOIN orders o ON oi.order_id = o.order_id
                   WHERE oi.order_item_id = ?";
    
    if ($stmt = $conn->prepare($orderQuery)) {
        $stmt->bind_param("i", $orderItemId);
        $stmt->execute();
        $orderResult = $stmt->get_result();

        if ($orderResult->num_rows > 0) {
            // Get order details (customer_id and product_id)
            $orderData = $orderResult->fetch_assoc();
            $customerId = $orderData['customer_id'];
            $productId = $orderData['product_id'];

            // Retrieve product details from the product_info table
            $productQuery = "SELECT Product_name, Product_image_path
                             FROM product_info
                             WHERE Product_id = ?";
            
            if ($productStmt = $conn->prepare($productQuery)) {
                $productStmt->bind_param("i", $productId);
                $productStmt->execute();
                $productResult = $productStmt->get_result();

                if ($productResult->num_rows > 0) {
                    $productData = $productResult->fetch_assoc();
                    $productName = $productData['Product_name'];
                    $productImage = $productData['Product_image_path'];
                } else {
                    $errorMsg = "Product not found.";
                }
                $productStmt->close();
            } else {
                $errorMsg = "Error preparing product query: " . $conn->error;
            }
        } else {
            $errorMsg = "Order item not found.";
        }
        $stmt->close();
    } else {
        $errorMsg = "Error preparing order query: " . $conn->error;
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $reviewDescription = isset($_POST['review_description']) ? $_POST['review_description'] : '';
        $rating = isset($_POST['rating']) ? $_POST['rating'] : 0;

        // Validate the input
        if (empty($reviewDescription) || $rating == 0) {
            $errorMsg = "Please provide a review description and a rating.";
        } else {
            // Insert the review into the review table
            $insertQuery = "INSERT INTO review (customer_id, product_id, review_description, rating)
                            VALUES (?, ?, ?, ?)";
            
            if ($insertStmt = $conn->prepare($insertQuery)) {
                $insertStmt->bind_param("iisi", $customerId, $productId, $reviewDescription, $rating);
                if ($insertStmt->execute()) {
                    $successMsg = "Thank you for your feedback!";
                } else {
                    $errorMsg = "Error submitting the review: " . $conn->error;
                }
                $insertStmt->close();
            } else {
                $errorMsg = "Error preparing insert query: " . $conn->error;
            }
        }
    }
} else {
    $errorMsg = "Invalid order item ID.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provide Feedback</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

<div class="max-w-7xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6">Provide Feedback for: <?php echo htmlspecialchars($productName); ?></h2>

    <?php
    if ($errorMsg) {
        echo "<div class='text-red-600'>$errorMsg</div>";
    }
    if ($successMsg) {
        echo "<div class='text-green-600'>$successMsg</div>";
    }
    ?>

    <div class="flex flex-col md:flex-row bg-white p-6 rounded-lg shadow-md">
        <div class="md:w-1/4 flex justify-center">
            <img src="<?php echo htmlspecialchars($productImage); ?>" alt="<?php echo htmlspecialchars($productName); ?>" class="w-40 h-40 object-cover rounded-md">
        </div>
        <div class="md:w-3/4 mt-4 md:mt-0">
            <form method="POST">
                <div class="mb-4">
                    <label for="review_description" class="block text-lg font-semibold">Write your review:</label>
                    <textarea id="review_description" name="review_description" class="w-full p-4 border rounded-md" rows="4" placeholder="Write your review here..."></textarea>
                </div>

                <div class="mb-4">
                    <label for="rating" class="block text-lg font-semibold">Rate this product:</label>
                    <div class="flex items-center space-x-1">
                        <?php
                        // Display 5 star options
                        for ($i = 1; $i <= 5; $i++) {
                            echo "<input type='radio' name='rating' value='$i' class='star-input' id='star$i' />";
                            echo "<label for='star$i' class='text-yellow-400'>★</label>";
                        }
                        ?>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-4">Submit Review</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
