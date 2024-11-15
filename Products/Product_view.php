<?php
// Include database connection
include 'DB_Connection.php'; // Make sure this file correctly connects to your database

// Get the product ID from the URL parameter
$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;

// Fetch product details based on Product_id
$sql = "SELECT * FROM product_info WHERE Product_id = $product_id";
$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);

// Check if the product exists
if (!$product) {
  echo '<p>Product not found.</p>';
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo htmlspecialchars($product['Product_name']); ?> - ZenithZone</title>

  <link rel="shortcut icon" href="./assets/images/logo/ZentihZone.png" type="image/x-icon" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body>
  <?php include "../Header_Footer/header.php"; ?>
  <main class="flex-grow container mx-auto px-4 py-8">
  <div class="flex flex-col md:flex-row items-center md:items-start text-center md:text-left">
    <!-- Product Image -->
    <div class="md:w-1/2 flex flex-col items-center">
      <div class="big-img mb-4">
      <img id="bigImg" src="<?php echo htmlspecialchars($product['Product_image_path']); ?>" alt="<?php echo htmlspecialchars($product['Product_name']); ?>" style="width: 300px; height: 300px; object-fit: cover;" class="rounded-lg shadow-lg" onclick="toggleImagePreview()" />

      </div>
    </div>

    <!-- Product Details -->
    <div class="md:w-1/2 md:ml-8 mt-8 md:mt-0 flex flex-col items-center md:items-start">
      <div class="pname text-3xl font-bold mb-2 mt-5"><?php echo htmlspecialchars($product['Product_name']); ?></div>
        <!-- Rating -->
        <div class="ratings text-yellow-500 mb-2">
          <?php
          $fullStars = floor($product['Rating']);
          $halfStar = ($product['Rating'] - $fullStars) >= 0.5 ? 1 : 0;
          $emptyStars = 5 - ($fullStars + $halfStar);

          for ($i = 0; $i < $fullStars; $i++) {
            echo '<i class="fas fa-star"></i>';
          }
          if ($halfStar) {
            echo '<i class="fas fa-star-half-alt"></i>';
          }
          for ($i = 0; $i < $emptyStars; $i++) {
            echo '<i class="far fa-star"></i>';
          }
          ?>
        </div>
      <!-- Price -->
      <div class="price text-2xl font-semibold mb-4">৳ <?php echo htmlspecialchars(number_format($product['New_price'], 2)); ?></div>

      <!-- Description -->
      <div class="size mb-4">
        <p class="text-gray-700 font-semibold">Description:</p>
        <p class="text-gray-700 leading-relaxed"><?php echo nl2br(htmlspecialchars($product['Product_Description'])); ?></p>
      </div>

      <!-- Quantity Section -->
      <div class="quantity mb-6 flex flex-col items-center md:flex-row md:items-center">
        <p class="text-gray-700 font-semibold mr-4">Quantity:</p>
        <div class="flex items-center space-x-2 bg-gray-100 p-2 rounded-lg shadow-md">
          <button class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full hover:bg-gray-300 transition duration-200" onclick="updateQuantity('decrement')">
            <i class="fas fa-minus"></i>
          </button>
          <input type="number" min="1" max="5" value="1" class="border-none text-center w-12 bg-white text-gray-700 font-semibold rounded-md focus:outline-none" />
          <button class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full hover:bg-gray-300 transition duration-200" onclick="updateQuantity('increment')">
            <i class="fas fa-plus"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
  
    <!-- Customer Reviews Section -->
    <div class="customer-reviews border border-gray-200 rounded-lg p-6 mt-10 shadow-sm">
      <h6 class="text-lg font-bold mb-6">Customer Reviews</h6>
      <div class="flex items-start mb-6">
        <div class="flex-shrink-0">
          <img src="./img/user-icon.png" alt="User Avatar" class="w-12 h-12 rounded-full shadow-md" />
        </div>
        <div class="ml-4">
          <div class="text-gray-800 font-semibold">Abir Mahmud</div>
          <div class="text-gray-600 mb-1">
            Rated <span class="text-yellow-500">★★★★☆</span>
          </div>
          <p class="text-gray-700">"Great T-shirt! Fits perfectly and feels very comfortable."</p>
        </div>
      </div>
    </div>
</main>


  <script src="./assets/js/script.js"></script>
  <script src="./Product_view.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <?php include "../Header_Footer/footer.php"; ?>
</body>

</html>