<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ZentihZone - eCommerce Website</title>

  <!--
        - favicon
      -->
  <link rel="shortcut icon" href="./assets/images/logo/ZentihZone.png" type="image/x-icon" />

  <!--
        - custom css link
      -->
  <!-- <link rel="stylesheet" href="./assets/css/style-prefix.css" /> -->

  <!--
        - google font link
      -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <style>
    /* Custom CSS for unique skew and hover animations */
    .form-entrance {
      transform: skewY(-5deg);
      transition: transform 0.3s cubic-bezier(0.075, 0.82, 0.165, 1),
        box-shadow 0.3s cubic-bezier(0.075, 0.82, 0.165, 1);
    }

    .form-entrance:hover {
      transform: skewY(0deg) scale(1.01);
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>

<body class="">
  <!--
    - HEADER
  -->
  <header>
    <!-- This first nav bar -->
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
                <input type="search" name="search" class="w-full pl-4 pr-20 py-2 border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border rounded-md" placeholder="Enter your product name..." />
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
              <a href="../Login/Login.php" class="text-[#fbad62] hover:text-white transition duration-150 ease-in-out">Login</a>
              <a href="../Registration/Who.php" class="text-[#fbad62] hover:text-white transition duration-150 ease-in-out">Signup</a>

              <!-- User Actions -->
              <button class="text-[#fbad62] hover:text-white">
                <ion-icon name="person-outline" class="h-6 w-6"></ion-icon>
              </button>
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
                <input type="search" name="search" class="w-full pl-4 pr-20 py-2 border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border rounded-md" placeholder="Enter your product name..." />
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

      <button class="btn btn-ghost" onclick="window.location= '../HomePage/InitialPage.php'">
        <ion-icon name="home-outline" class="text-2xl"></ion-icon>
      </button>

      <button class="btn btn-ghost relative">
        <ion-icon name="heart-outline" class="text-2xl"></ion-icon>
        <span class="badge badge-sm badge-error absolute -top-1 -right-1">0</span>
      </button>

      <button class="btn btn-ghost" data-mobile-menu-open-btn>
        <ion-icon name="grid-outline" class="text-2xl"></ion-icon>
      </button>
    </div>
  </header>
  <div class="w-full h-screen flex items-center justify-center mt-16">
    <div class="py-10 px-4 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold mb-8 text-center text-indigo-500">
        I am a ...
      </h1>
      <div class="flex justify-center">
        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 gap-6">
          <!-- Customer Card -->
          <div class="bg-white shadow-lg rounded-lg overflow-hidden relative group hover:border-green-500 hover:border-2 transition duration-300 w-48">
            <a href="./customerreg.php" class="">
              <img src="../assets/images/logo/customer.svg" alt="Customer" class="w-full object-scale-down h-48 transition duration-300 ease-in-out" />
              <div class="text-center py-2 font-semibold">Customer</div>
            </a>
          </div>

          <!-- Seller Card -->
          <div class="bg-white shadow-lg rounded-lg overflow-hidden relative group hover:border-green-500 hover:border-2 transition duration-300 w-48">
            <a href="./sellereg.php" class="">
              <img src="../assets/images/logo/Seller.png" alt="Seller" class="w-full object-scale-down h-48 transition duration-300 ease-in-out" />
              <div class="text-center py-2 font-semibold">Seller</div>
            </a>
          </div>

          <!-- Artist Card -->
          <div class="bg-white shadow-lg rounded-lg overflow-hidden relative group hover:border-green-500 hover:border-2 transition duration-300 w-48">
            <a href="./artistreg.php" class="">
              <img src="../assets/images/logo/Artist.svg" alt="Artist" class="w-full object-scale-down h-48 transition duration-300 ease-in-out" />
              <div class="text-center py-2 font-semibold">Artist</div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

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
  <!--
  - ionicon link
-->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>