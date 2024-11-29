<?php
// Include the database connection file
include "../Database_Connection/DB_Connection.php"; // Make sure this file contains the $conn variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve and sanitize form inputs
    $coupon_code = mysqli_real_escape_string($conn, $_POST['coupon_code']);
    $coupon_name = mysqli_real_escape_string($conn, $_POST['coupon_name']);
    $coupon_description = mysqli_real_escape_string($conn, $_POST['coupon_description']);
    $discount_rate = mysqli_real_escape_string($conn, $_POST['discount_rate']);
    $minimum_price = mysqli_real_escape_string($conn, $_POST['minimum_price']);
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);

    // Determine the status based on the current date and the end date
    $current_time = date('Y-m-d H:i:s'); // Get current timestamp
    if ($current_time > $end_date) {
        $status = 'Inactive'; // Set to inactive if current time is greater than the end date
    } else {
        $status = 'Active'; // Otherwise, set to active
    }

    // Insert the coupon data into the database
    $query = "INSERT INTO Coupon (coupon_code, coupon_name, coupon_description, discount_rate, minimum_price, start_date, end_date, status) 
              VALUES ('$coupon_code', '$coupon_name', '$coupon_description', '$discount_rate', '$minimum_price', '$start_date', '$end_date', '$status')";
    
    if (mysqli_query($conn, $query)) {
        echo "Coupon created successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <form method="POST" class="max-w-lg mx-auto p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-xl font-semibold text-gray-800 mb-6 text-center">Generate New Coupon</h2>
    
        <!-- Coupon Code -->
        <div class="mt-4">
            <label for="coupon_code" class="text-gray-800 text-xs block mb-2">Coupon Code</label>
            <input id="coupon_code" name="coupon_code" type="text" required class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" placeholder="Enter coupon code (e.g., SAVE20)" />
        </div>
    
        <!-- Coupon Name -->
        <div class="mt-4">
            <label for="coupon_name" class="text-gray-800 text-xs block mb-2">Coupon Name</label>
            <input id="coupon_name" name="coupon_name" type="text" required class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" placeholder="Enter coupon name" />
        </div>
    
        <!-- Coupon Description -->
        <div class="mt-4">
            <label for="coupon_description" class="text-gray-800 text-xs block mb-2">Coupon Description</label>
            <textarea id="coupon_description" name="coupon_description" class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" placeholder="Enter coupon description"></textarea>
        </div>
    
        <!-- Discount Rate -->
        <div class="mt-4">
            <label for="discount_rate" class="text-gray-800 text-xs block mb-2">Discount Rate (1-100%)</label>
            <input id="discount_rate" name="discount_rate" type="number" min="1" max="100" required class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" placeholder="Enter discount rate" />
        </div>
    
        <!-- Minimum Price -->
        <div class="mt-4">
            <label for="minimum_price" class="text-gray-800 text-xs block mb-2">Minimum Price</label>
            <input id="minimum_price" name="minimum_price" type="number" required class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" placeholder="Enter minimum price" />
        </div>
    
        <!-- Start Date -->
        <div class="mt-4">
            <label for="start_date" class="text-gray-800 text-xs block mb-2">Start Date</label>
            <input id="start_date" name="start_date" type="datetime-local" required class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" />
        </div>
    
        <!-- End Date -->
        <div class="mt-4">
            <label for="end_date" class="text-gray-800 text-xs block mb-2">End Date</label>
            <input id="end_date" name="end_date" type="datetime-local" required class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" />
        </div>
    
        <!-- Submit Button -->
        <div class="mt-6 text-center">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">Generate Coupon</button>
        </div>
    </form>
</body>
</html>
