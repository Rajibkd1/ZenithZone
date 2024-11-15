<?php
if (isset($_GET['term'])) {
  // Database configuration
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "ZenithZone";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $searchTerm = $_GET['term'] ?? '';

  // Fetching data from database, limiting results to 5
  $query = $conn->prepare("SELECT products FROM autocom WHERE products LIKE ? LIMIT 5");
  $searchTerm = $searchTerm . '%';  // Adjusted to match starting characters
  $query->bind_param("s", $searchTerm);
  $query->execute();
  $result = $query->get_result();

  $suggestions = [];
  while ($row = $result->fetch_assoc()) {
    $suggestions[] = $row['products'];
  }

  echo json_encode($suggestions);

  // Close connection
  $query->close();
  $conn->close();
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ZenithZone - eCommerce Website</title>

  <!-- favicon -->
  <link rel="shortcut icon" href="../assets/images/logo/ZentihZone.png" type="image/x-icon">

  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css">

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- Custom css link -->
  <link rel="stylesheet" href="./backgorund.css">
</head>

<body>
  <!-- This is for Background -->
  <canvas class="background-canvas" id="backgroundCanvas"></canvas>
  <!--
    - HEADER
  -->
    <?php
    include'../Header_Footer/fixed_header.php';
    ?>


  <!--
    - MAIN
  -->

  <main>


    <!--
      - PRODUCT
    -->

    <!-- This Product container  -->
    <div class="container mx-auto px-4">
      <div class="flex flex-col">
        <!-- Product Main -->
        <div class="text-center py-6">
          <h2 class="text-3xl font-bold text-gray-800 mb-6">New Products</h2>
          <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            <!-- Product Showcase -->

            <!-- 1st Product -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden relative group hover:border-red-500 hover:border-2 transition duration-300 w-48">
              <img src="../assets/images/products/jacket-1.jpg" alt="Mens Jacket" class="w-full h-32 object-cover transition duration-300 ease-in-out" />
              <div class="absolute inset-y-0 right-0 flex flex-col items-center justify-center gap-2 transform translate-x-full transition-transform duration-300 ease-in-out group-hover:translate-x-0 bg-black bg-opacity-0 p-2">
                <button class="text-blue-500 text-md p-0.5 rounded">
                  <i class="far fa-heart"></i>
                </button>
                <button class="text-blue-500 text-md p-0.5 rounded">
                  <i class="far fa-eye"></i>
                </button>
                <button class="text-blue-500 text-md p-0.5 rounded">
                  <i class="fas fa-shopping-bag"></i>
                </button>
              </div>

              <div class="p-2">
                <a href="#" class="inline-block text-blue-500 hover:text-blue-600 text-sm">JACKET</a>
                <h3 class="text-sm font-medium text-gray-800 mb-1">
                  <a href="#">Mens Jacket</a>
                </h3>
                <div class="flex items-center mb-1">
                  <i class="fas fa-star text-yellow-400"></i>
                  <i class="fas fa-star text-yellow-400"></i>
                  <i class="fas fa-star text-yellow-400"></i>
                  <i class="far fa-star text-yellow-400"></i>
                  <i class="fas fa-star-half-alt text-yellow-400"></i>
                </div>
                <div class="flex items-baseline space-x-1 font-bold">
                  <p class="text-sm text-blue-500">$25.00</p>
                  <del class="text-xs text-gray-400">$35.00</del>
                </div>
              </div>
            </div>
            <!-- 2nd Product -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden relative group hover:border-red-500 hover:border-2 transition duration-300 w-48">
              <img src="../assets/images/products/clothes-1.jpg" alt="Mens Jacket" class="w-full h-32 object-cover transition duration-300 ease-in-out" />
              <div class="absolute inset-y-0 right-0 flex flex-col items-center justify-center gap-2 transform translate-x-full transition-transform duration-300 ease-in-out group-hover:translate-x-0 bg-black bg-opacity-0 p-2">
                <button class="text-blue-500 text-md p-0.5 rounded">
                  <i class="far fa-heart"></i>
                </button>
                <button class="text-blue-500 text-md p-0.5 rounded">
                  <i class="far fa-eye"></i>
                </button>
                <button class="text-blue-500 text-md p-0.5 rounded">
                  <i class="fas fa-shopping-bag"></i>
                </button>
              </div>

              <div class="p-2">
                <a href="#" class="inline-block text-blue-500 hover:text-blue-600 text-sm">JACKET</a>
                <h3 class="text-sm font-medium text-gray-800 mb-1">
                  <a href="#">Mens Jacket</a>
                </h3>
                <div class="flex items-center mb-1">
                  <i class="fas fa-star text-yellow-400"></i>
                  <i class="fas fa-star text-yellow-400"></i>
                  <i class="fas fa-star text-yellow-400"></i>
                  <i class="far fa-star text-yellow-400"></i>
                  <i class="fas fa-star-half-alt text-yellow-400"></i>
                </div>
                <div class="flex items-baseline space-x-1 font-bold">
                  <p class="text-sm text-blue-500">$25.00</p>
                  <del class="text-xs text-gray-400">$35.00</del>
                </div>
              </div>
            </div>
            <!-- 3rdd Product -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden relative group hover:border-red-500 hover:border-2 transition duration-300 w-48">
              <img src="../assets/images/products/watch-2.jpg" alt="Mens Watch" class="w-full h-32 object-cover transition duration-300 ease-in-out" />
              <div class="absolute inset-y-0 right-0 flex flex-col items-center justify-center gap-2 transform translate-x-full transition-transform duration-300 ease-in-out group-hover:translate-x-0 bg-black bg-opacity-0 p-2">
                <button class="text-blue-500 text-md p-0.5 rounded">
                  <i class="far fa-heart"></i>
                </button>
                <button class="text-blue-500 text-md p-0.5 rounded">
                  <i class="far fa-eye"></i>
                </button>
                <button class="text-blue-500 text-md p-0.5 rounded">
                  <i class="fas fa-shopping-bag"></i>
                </button>
              </div>

              <div class="p-2">
                <a href="#" class="inline-block text-blue-500 hover:text-blue-600 text-sm">JACKET</a>
                <h3 class="text-sm font-medium text-gray-800 mb-1">
                  <a href="#">Mens Jacket</a>
                </h3>
                <div class="flex items-center mb-1">
                  <i class="fas fa-star text-yellow-400"></i>
                  <i class="fas fa-star text-yellow-400"></i>
                  <i class="fas fa-star text-yellow-400"></i>
                  <i class="far fa-star text-yellow-400"></i>
                  <i class="fas fa-star-half-alt text-yellow-400"></i>
                </div>
                <div class="flex items-baseline space-x-1 font-bold">
                  <p class="text-sm text-blue-500">$25.00</p>
                  <del class="text-xs text-gray-400">$35.00</del>
                </div>
              </div>
            </div>
            <!-- 4th Product -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden relative group hover:border-red-500 hover:border-2 transition duration-300 w-48">
              <img src="../assets/images/products/jewellery-2.jpg" alt="Beautiful Jewellery" class="w-full h-32 object-cover transition duration-300 ease-in-out" />
              <div class="absolute inset-y-0 right-0 flex flex-col items-center justify-center gap-2 transform translate-x-full transition-transform duration-300 ease-in-out group-hover:translate-x-0 bg-black bg-opacity-0 p-2">
                <button class="text-blue-500 text-md p-0.5 rounded">
                  <i class="far fa-heart"></i>
                </button>
                <button class="text-blue-500 text-md p-0.5 rounded">
                  <i class="far fa-eye"></i>
                </button>
                <button class="text-blue-500 text-md p-0.5 rounded">
                  <i class="fas fa-shopping-bag"></i>
                </button>
              </div>

              <div class="p-2">
                <a href="#" class="inline-block text-blue-500 hover:text-blue-600 text-sm">Jewellery</a>
                <h3 class="text-sm font-medium text-gray-800 mb-1">
                  <a href="#">Beautiful Jewellery</a>
                </h3>
                <div class="flex items-center mb-1">
                  <i class="fas fa-star text-yellow-400"></i>
                  <i class="fas fa-star text-yellow-400"></i>
                  <i class="fas fa-star text-yellow-400"></i>
                  <i class="fas fa-star-half-alt text-yellow-400"></i>
                  <i class="far fa-star text-yellow-400"></i>
                </div>
                <div class="flex items-baseline space-x-1 font-bold">
                  <p class="text-sm text-blue-500">$25.00</p>
                  <del class="text-xs text-gray-400">$35.00</del>
                </div>
              </div>
            </div>
            <!-- 5th Product -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden relative group hover:border-red-500 hover:border-2 transition duration-300 w-48">
              <img src="../assets/images/products/shoe-3.jpg" alt="Beautiful Jewellery" class="w-full h-32 object-cover transition duration-300 ease-in-out" />
              <div class="absolute inset-y-0 right-0 flex flex-col items-center justify-center gap-2 transform translate-x-full transition-transform duration-300 ease-in-out group-hover:translate-x-0 bg-black bg-opacity-0 p-2">
                <button class="text-blue-500 text-md p-0.5 rounded">
                  <i class="far fa-heart"></i>
                </button>
                <button class="text-blue-500 text-md p-0.5 rounded">
                  <i class="far fa-eye"></i>
                </button>
                <button class="text-blue-500 text-md p-0.5 rounded">
                  <i class="fas fa-shopping-bag"></i>
                </button>
              </div>

              <div class="p-2">
                <a href="#" class="inline-block text-blue-500 hover:text-blue-600 text-sm">MAN SHOES</a>
                <h3 class="text-sm font-medium text-gray-800 mb-1">
                  <a href="#">Man Formal shoes</a>
                </h3>
                <div class="flex items-center mb-1">
                  <i class="fas fa-star text-yellow-400"></i>
                  <i class="fas fa-star text-yellow-400"></i>
                  <i class="fas fa-star text-yellow-400"></i>
                  <i class="fas fa-star-half-alt text-yellow-400"></i>
                  <i class="far fa-star text-yellow-400"></i>
                </div>
                <div class="flex items-baseline space-x-1 font-bold">
                  <p class="text-sm text-blue-500">$25.00</p>
                  <del class="text-xs text-gray-400">$35.00</del>
                </div>
              </div>
            </div>
            <!--  6th Product -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden relative group hover:border-red-500 hover:border-2 transition duration-300 w-48">
              <img src="../assets/images/products/clothes-1.jpg" alt="Mens Jacket" class="w-full h-32 object-cover transition duration-300 ease-in-out" />
              <div class="absolute inset-y-0 right-0 flex flex-col items-center justify-center gap-2 transform translate-x-full transition-transform duration-300 ease-in-out group-hover:translate-x-0 bg-black bg-opacity-0 p-2">
                <button class="text-blue-500 text-md p-0.5 rounded">
                  <i class="far fa-heart"></i>
                </button>
                <button class="text-blue-500 text-md p-0.5 rounded">
                  <i class="far fa-eye"></i>
                </button>
                <button class="text-blue-500 text-md p-0.5 rounded">
                  <i class="fas fa-shopping-bag"></i>
                </button>
              </div>

              <div class="p-2">
                <a href="#" class="inline-block text-blue-500 hover:text-blue-600 text-sm">JACKET</a>
                <h3 class="text-sm font-medium text-gray-800 mb-1">
                  <a href="#">Mens Jacket</a>
                </h3>
                <div class="flex items-center mb-1">
                  <i class="fas fa-star text-yellow-400"></i>
                  <i class="fas fa-star text-yellow-400"></i>
                  <i class="fas fa-star text-yellow-400"></i>
                  <i class="far fa-star text-yellow-400"></i>
                  <i class="fas fa-star-half-alt text-yellow-400"></i>
                </div>
                <div class="flex items-baseline space-x-1 font-bold">
                  <p class="text-sm text-blue-500">$25.00</p>
                  <del class="text-xs text-gray-400">$35.00</del>
                </div>
              </div>
            </div>
            <!-- Repeat for other products with respective details -->
          </div>
        </div>
      </div>
    </div>
  </main>


  <!--
    - FOOTER
  -->
  <footer class="bg-gray-800 py-6">
    <div class="container mx-auto text-center">
      <img src="../assets/images/payment.png" alt="payment method" class="mx-auto mb-4" />
      <p class="text-gray-400">
        Copyright &copy; ZentihZone All Rights Reserved.
      </p>
    </div>
  </footer>

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!--
    - custom js link
  -->
  <script src="./auto.js"></script>
  <script src="./background.js"></script>

  <!--
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>