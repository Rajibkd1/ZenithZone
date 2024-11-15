<?php
include "../Database_Connection/DB_Connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $productCode = trim(strtolower($_POST['productCode']));
    $productName = $_POST['productName'];
    $productCategory = $_POST['productCategory'];
    $productDescription = $_POST['productDescription'];
    $newPrice = floatval($_POST['productPrice']);
    $stockQuantity = intval($_POST['stockQuantity']);
    $stockStatus = ($stockQuantity > 0) ? "Yes" : "No";

    // Handle file upload for the product image
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    $targetFile = $targetDir . basename($_FILES["productImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Validate if the file is an actual image
    $check = getimagesize($_FILES["productImage"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
        $uploadError = "File is not an image.";
    }

    if ($uploadOk && move_uploaded_file($_FILES["productImage"]["tmp_name"], $targetFile)) {
        $productImagePath = $targetFile;

        // Check if the product code already exists
        $sql_check = "SELECT * FROM product_info_new WHERE Product_code = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("s", $productCode);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            $error_message = "Error: Duplicate entry for product code.";
        } else {
            // Insert product into database
            $sql = "INSERT INTO product_info_new (Product_code, Product_name, Product_category, Product_Description, Product_image_path, New_price, Stock_quantity, Stock_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssdss", $productCode, $productName, $productCategory, $productDescription, $productImagePath, $newPrice, $stockQuantity, $stockStatus);

            if ($stmt->execute()) {
                $product_added = true;
            } else {
                $error_message = "Database error: " . $stmt->error;
            }
            $stmt->close();
        }
        $stmt_check->close();
    } else {
        $error_message = isset($uploadError) ? $uploadError : "There was an error uploading your file.";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script>
        // Function to automatically close the modal and redirect after 3 seconds
        function closeModalAndRedirect(redirectUrl) {
            setTimeout(function() {
                const modal = document.querySelector('dialog[open]');
                if (modal) {
                    modal.close(); // Close the open modal
                }
                window.location.href = redirectUrl; // Redirect to the specified URL
            }, 3000); // 3000 milliseconds = 3 seconds
        }
    </script>
</head>

<body>
    <?php if (isset($product_added) && $product_added): ?>
        <dialog id="successModal" open class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg p-5 shadow text-center">
                <i class="fa-solid fa-circle-check fa-5x" style="color: #3feeba;"></i>
                <h3 class="text-lg font-bold mt-4">Product Added Successfully!</h3>
                <p class="mt-2 text-green-700">The new product has been added to the inventory.</p>
                <div class="flex justify-center mt-4">
                    <button onclick="closeModalAndRedirect('admin.php');" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Close</button>
                </div>
            </div>
        </dialog>
        <script>
            closeModalAndRedirect('admin.php');
        </script>
    <?php elseif (isset($error_message)): ?>
        <dialog id="errorModal" open class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg p-5 shadow text-center">
                <i class="fa-solid fa-circle-xmark fa-5x" style="color: #ff4b0f;"></i>
                <h3 class="text-lg font-bold text-red-700 mt-4">Product Addition Error</h3>
                <p class="mt-2"><?php echo $error_message; ?></p>
                <div class="flex justify-center mt-4">
                    <button onclick="closeModalAndRedirect('admin.php');" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Close</button>
                </div>
            </div>
        </dialog>
        <script>
            closeModalAndRedirect('admin.php');
        </script>
    <?php endif; ?>

    <!-- Product Form -->
    <form id="productForm" action="add_products.php" method="POST" enctype="multipart/form-data" class="p-8" onsubmit="return validateForm();">
        <h1 class="text-center font-bold text-black text-xl">Create A New Product</h1>
        <!-- Product Name -->
        <div class="mt-8">
            <label class="text-gray-800 text-xs block mb-2">Product Name</label>
            <input id="productName" name="productName" type="text" required class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" placeholder="Enter product name" />
        </div>

        <!-- Product Code -->
        <div class="mt-8">
            <label class="text-gray-800 text-xs block mb-2">Product Code</label>
            <input id="productCode" name="productCode" type="text" required class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" placeholder="Enter product code" />
        </div>

        <!-- Product Category -->
        <div class="mt-8">
            <label class="text-gray-800 text-xs block mb-2">Product Category</label>
            <input id="productCategory" name="productCategory" type="text" required class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" placeholder="Enter product category" />
        </div>

        <!-- Product Description -->
        <div class="mt-8">
            <label class="text-gray-800 text-xs block mb-2">Product Description</label>
            <textarea id="productDescription" name="productDescription" required class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" placeholder="Enter product description"></textarea>
        </div>

        <!-- Product Price -->
        <div class="mt-8">
            <label class="text-gray-800 text-xs block mb-2">Product Price</label>
            <input id="productPrice" name="productPrice" type="number" step="0.01" required class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" placeholder="Enter product price" />
        </div>

        <!-- Stock Quantity -->
        <div class="mt-8">
            <label class="text-gray-800 text-xs block mb-2">Stock Quantity</label>
            <input id="stockQuantity" name="stockQuantity" type="number" required class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" placeholder="Enter stock quantity" />
        </div>

        <!-- Product Image -->
        <div class="mt-8">
            <label class="text-gray-800 text-xs block mb-2">Product Image</label>
            <input id="productImage" name="productImage" type="file" required class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" />
        </div>

        <!-- Submit Button -->
        <div class="flex justify-center mt-12">
            <button type="submit" class="py-3.5 px-7 text-sm font-semibold tracking-wider rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">Submit</button>
        </div>

    </form>

    <script src="./add_product.js"></script>

</body>

</html>