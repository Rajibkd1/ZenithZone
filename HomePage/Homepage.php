<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../Login/Login.php");
    exit;
}

// Check if the first_name session variable is set and assign it or use 'User' as a default
$first_name = $_SESSION['first_name'] ?? 'User';


// Check if the term is present in the GET request
if (isset($_GET['term'])) {
    $servername = "localhost";
    $username = "id22413670_root";  // Update to your username
    $password = "R@jib2589";  // Update to your password
    $dbname = "id22413670_zenithzone";  // Update to your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $searchTerm = $_GET['term'] . '%';
    $query = $conn->prepare("SELECT products FROM autocom WHERE products LIKE ?");
    $query->bind_param("s", $searchTerm);
    $query->execute();
    $result = $query->get_result();

    $suggestions = [];
    while ($row = $result->fetch_assoc()) {
        $suggestions[] = $row['products'];
    }

    echo json_encode($suggestions);
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

    <!-- HEADER -->
    <header>
        <!-- Fixed navigation bar with interactive animated background -->
        <div class="fixed top-0 left-0 right-0 z-50 group">
            <!-- Animated gradient background with hover effect -->
            <div class="absolute -inset-1 bg-gradient-to-r from-red-600 to-violet-600 rounded-lg blur opacity-25 transition-opacity duration-1000 group-hover:opacity-100"></div>

            <!-- Navigation content -->
            <div class="relative bg-[#363b41] py-5 w-full">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col sm:flex-row justify-between items-center">
                        <!-- Logo -->
                        <a href="#" class="flex-shrink-0">
                            <img src="../assets/images/logo/ZentihZone.png" alt="ZenithZone logo" class="h-16 sm:h-20" />
                        </a>

                        <!-- Search Field For Large Device -->
                        <div class="flex-grow mx-10 my-2 sm:my-0 hidden md:block">
                            <div class="relative">
                                <input type="search" name="search" class="input-field w-full pl-4 pr-20 py-2 border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border rounded-md" placeholder="Enter your product name..." />
                                <!-- Autocomplete Suggestions Box -->
                                <ul class="autobox absolute z-10 bg-white w-full shadow-lg max-h-60 overflow-y-auto"></ul>
                                <!-- Search Button -->
                                <button class="absolute inset-y-0 right-10 px-3 flex items-center">
                                    <ion-icon name="search-outline" class="h-5 w-5 text-gray-500"></ion-icon>
                                </button>
                                <!-- Voice Search Button -->
                                <button class="absolute inset-y-0 right-0 px-3 flex items-center">
                                    <ion-icon name="mic-outline" class="h-5 w-5 text-gray-500"></ion-icon>
                                </button>
                            </div>
                        </div>

                        <!-- User Actions and Authentication -->
                        <div class="flex items-center space-x-4 mt-2 sm:mt-0">
                            <!-- Authentication Links -->
                            <a href="./InitialPage.php" class="text-[#fbad62] hover:text-white transition duration-150 ease-in-out">Logout</a>
                            
                            <!-- User Actions -->
                            <button class="text-[#fbad62] hover:text-white">
                                <ion-icon name="person-outline" class="h-6 w-6"></ion-icon>
                            </button>
                            <a href="#" class="text-[#fbad62] hover:text-white transition duration-150 ease-in-out"><?php echo htmlspecialchars($first_name); ?></a>
                            <button class="relative text-[#fbad62] hover:text-white">
                                <ion-icon name="heart-outline" class="h-6 w-6"></ion-icon>
                                <span class="absolute -top-2 -right-2 rounded-full bg-red-500 text-white text-xs px-2 py-1">0</span>
                            </button>
                            <button class="relative text-[#fbad62] hover:text-white">
                                <ion-icon name="bag-handle-outline" class="h-6 w-6"></ion-icon>
                                <span class="absolute -top-2 -right-2 rounded-full bg-red-500 text-white text-xs px-2 py-1">0</span>
                            </button>
                        </div>
                        <!-- Search Field for Small device  -->
                        <div class="flex-grow mx-10 my-2 sm:my-0 block sm:hidden">
                            <div class="relative">
                                <input type="search" name="search" class="input-field w-full pl-4 pr-20 py-2 border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border rounded-md" placeholder="Enter your product name..." />
                                <!-- Autocomplete Suggestions Box -->
                                <ul class="autobox absolute z-10 bg-white w-full shadow-lg max-h-60 overflow-y-auto"></ul>
                                <!-- Search Button -->
                                <button class="absolute inset-y-0 right-10 px-3 flex items-center">
                                    <ion-icon name="search-outline" class="h-5 w-5 text-gray-500"></ion-icon>
                                </button>
                                <!-- Voice Search Button -->
                                <button class="absolute inset-y-0 right-0 px-3 flex items-center">
                                    <ion-icon name="mic-outline" class="h-5 w-5 text-gray-500"></ion-icon>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Second nav -->
        <nav class="bg-gradient-to-r from-indigo-500 from-10% via-sky-500 via-30% to-emerald-500 to-90% hidden fixed top-[120px] sm:block w-full z-40">
            <div class="container mx-auto px-4 py-3">
                <ul class="flex flex-wrap justify-center items-center gap-6 lg:gap-8 xl:gap-10">
                    <li>
                        <a href="#" class="text-slate-50 font-bold hover:text-indigo-500">Home</a>
                    </li>
                    <li class="dropdown dropdown-hover">
                        <div tabindex="0" role="button" class="text-slate-50 font-bold hover:text-indigo-500">
                            Categories
                        </div>
                        <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-50 min-w-96 p-4 shadow grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div>
                                <h3 class="font-semibold mb-2">Electronics</h3>
                                <ul class="space-y-1">
                                    <li>
                                        <a href="#" class="text-gray-600 hover:text-indigo-500">Desktop</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-600 hover:text-indigo-500">Laptop</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-600 hover:text-indigo-500">Camera</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-600 hover:text-indigo-500">Tablet</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-600 hover:text-indigo-500">Headphone</a>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="font-semibold mb-2">Men's</h3>
                                <ul class="space-y-1">
                                    <li>
                                        <a href="#" class="text-gray-600 hover:text-indigo-500">Formal</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-600 hover:text-indigo-500">Casual</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-600 hover:text-indigo-500">Sports</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-600 hover:text-indigo-500">Jacket</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-600 hover:text-indigo-500">Sunglasses</a>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="font-semibold mb-2">Women's</h3>
                                <ul class="space-y-1">
                                    <li>
                                        <a href="#" class="text-gray-600 hover:text-indigo-500">Formal</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-600 hover:text-indigo-500">Casual</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-600 hover:text-indigo-500">Perfume</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-600 hover:text-indigo-500">Cosmetics</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-600 hover:text-indigo-500">Bags</a>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h3 class="font-semibold mb-2">Accessories</h3>
                                <ul class="space-y-1">
                                    <li>
                                        <a href="#" class="text-gray-600 hover:text-indigo-500">Smart Watch</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-600 hover:text-indigo-500">Smart TV</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-600 hover:text-indigo-500">Keyboard</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-600 hover:text-indigo-500">Mouse</a>
                                    </li>
                                    <li>
                                        <a href="#" class="text-gray-600 hover:text-indigo-500">Microphone</a>
                                    </li>
                                </ul>
                            </div>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-hover">
                        <div tabindex="0" role="button" class="text-slate-50 font-bold hover:text-indigo-500">
                            Art or Craft
                        </div>
                        <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
                            <li>
                                <a href="#" class="text-gray-600 hover:text-indigo-500">Shirt</a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-600 hover:text-indigo-500">Shorts & Jeans</a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-600 hover:text-indigo-500">Safety Shoes</a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-600 hover:text-indigo-500">Wallet</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-hover">
                        <div tabindex="0" role="button" class="text-slate-50 font-bold hover:text-indigo-500">
                            Second Hand Products
                        </div>
                        <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
                            <li>
                                <a href="#" class="text-gray-600 hover:text-indigo-500">Shirt</a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-600 hover:text-indigo-500">Shorts & Jeans</a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-600 hover:text-indigo-500">Safety Shoes</a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-600 hover:text-indigo-500">Wallet</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-hover">
                        <div tabindex="0" role="button" class="text-slate-50 font-bold hover:text-indigo-500">
                            Men's
                        </div>
                        <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
                            <li>
                                <a href="#" class="text-gray-600 hover:text-indigo-500">Shirt</a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-600 hover:text-indigo-500">Shorts & Jeans</a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-600 hover:text-indigo-500">Safety Shoes</a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-600 hover:text-indigo-500">Wallet</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-hover">
                        <div tabindex="0" role="button" class="text-slate-50 font-bold hover:text-indigo-500">
                            Women's
                        </div>
                        <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
                            <li>
                                <a href="#" class="text-gray-600 hover:text-indigo-500">Dress & Frock</a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-600 hover:text-indigo-500">Earrings</a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-600 hover:text-indigo-500">Necklace</a>
                            </li>
                            <li>
                                <a href="#" class="text-gray-600 hover:text-indigo-500">Makeup Kit</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Nav ber for mobile version  -->
        <div class="fixed inset-x-0 bottom-0 bg-white shadow-lg p-2 z-50 flex justify-around items-center sm:hidden">
            <div class="relative">
                <div class="dropdown dropdown-top dropdown-hover">
                    <div tabindex="0" role="button" class="btn m-1 btn-ghost">
                        <ion-icon name="menu-outline" class="text-2xl"></ion-icon>
                    </div>
                    <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
                        <li><a href="#">Art and Craft</a></li>
                        <li><a href="#">Second hand Product</a></li>
                        <li><a href="#">Electronics</a></li>
                        <li><a href="#">Men's Items</a></li>
                        <li><a href="#">Women's Items</a></li>
                        <li><a href="#">Accessories</a></li>
                    </ul>
                </div>
            </div>

            <button class="btn btn-ghost relative">
                <ion-icon name="bag-handle-outline" class="text-2xl"></ion-icon>
                <span class="badge badge-sm badge-error absolute -top-1 -right-1">0</span>
            </button>

            <button class="btn btn-ghost" onclick="window.location.href = './Homepage.php'">
                <ion-icon name="home-outline" class="text-2xl"></ion-icon>
            </button>>

            <button class="btn btn-ghost relative">
                <ion-icon name="heart-outline" class="text-2xl"></ion-icon>
                <span class="badge badge-sm badge-error absolute -top-1 -right-1">0</span>
            </button>

            <button class="btn btn-ghost" data-mobile-menu-open-btn>
                <ion-icon name="grid-outline" class="text-2xl"></ion-icon>
            </button>
        </div>
    </header>

    <!--
    - MAIN
  -->

    <main>
        <!--
      - BANNER
    -->
        <div id="default-carousel" class="relative w-full overflow-hidden mt-48" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                <!-- Item 1 -->
                <div class="carousel-item absolute w-full h-full transition-transform duration-700 ease-in-out" data-carousel-item>
                    <img src="../assets/images/Art.jpg" class="block w-full h-full object-cover" alt="Art and Craft" />
                    <div class="absolute bottom-5 left-1/2 transform -translate-x-1/2 flex flex-col items-center text-white">
                        <h2 class="text-center text-3xl md:text-5xl">
                            See All Creative Art Works
                        </h2>
                        <a href="#" class="btn btn-primary mt-4">Explore</a>
                    </div>
                </div>
                <!-- Item 2 -->
                <div class="carousel-item absolute w-full h-full transition-transform duration-700 ease-in-out" data-carousel-item>
                    <img src="../assets/images/OldMobile.jpg" class="block w-full h-full object-cover" alt="Second Hand Products" />
                    <div class="absolute bottom-5 left-1/2 transform -translate-x-1/2 flex flex-col items-center text-white">
                        <h2 class="text-center text-3xl md:text-5xl">
                            See Second Hand Products
                        </h2>
                        <a href="#" class="btn btn-primary mt-4">Explore</a>
                    </div>
                </div>
                <!-- Item 3 -->
                <div class="carousel-item absolute w-full h-full transition-transform duration-700 ease-in-out" data-carousel-item>
                    <img src="../assets/images/banner-3.jpg" class="block w-full h-full object-cover" alt="New Arrival Products" />
                    <div class="absolute bottom-5 left-1/2 transform -translate-x-1/2 flex flex-col items-center text-white">
                        <h2 class="text-center text-3xl md:text-5xl">
                            See New Arrival Products
                        </h2>
                        <a href="#" class="btn btn-primary mt-4">Explore</a>
                    </div>
                </div>
            </div>
            <!-- Slider indicators -->
            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse" data-carousel-indicators>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
            </div>
            <!-- Slider controls -->
            <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>
        <!--
      - CATEGORY
    -->

        <!--
      - PRODUCT
    -->

    <h1 class="text-4xl font-bold text-center mt-10 text-indigo-600 drop-shadow-lg h-56">
            Hi <strong class="text-5xl text-purple-600"><?php echo htmlspecialchars($first_name); ?></strong>, Welcome to ZenithZone
        </h1>

        
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