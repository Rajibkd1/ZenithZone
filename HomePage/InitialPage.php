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
    <link
      rel="shortcut icon"
      href="../assets/images/logo/ZentihZone.png"
      type="image/x-icon"
    />

    <!--
    - google font link
  -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.0/dist/tailwind.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <!-- This style for the background -->
    <style>
      body {
        margin: 0;
      }
      .background-canvas {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
      }
      .content {
        position: relative;
        z-index: 1;
      }
    </style>
  </head>

  <body>
    <!-- This is for Background -->
    <canvas class="background-canvas" id="backgroundCanvas"></canvas>
    <!--
    - HEADER
  -->
    <header>
      <!-- This first nav bar -->
      <!-- Fixed navigation bar with interactive animated background -->
      <div class="fixed top-0 left-0 right-0 z-50 group">
        <!-- Animated gradient background with hover effect -->
        <div
          class="absolute -inset-1 bg-gradient-to-r from-red-600 to-violet-600 rounded-lg blur opacity-25 transition-opacity duration-1000 group-hover:opacity-100"
        ></div>

        <!-- Navigation content -->
        <div class="relative bg-neutral-300 py-5 w-full">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row justify-between items-center">
              <!-- Logo -->
              <a href="#" class="flex-shrink-0">
                <img
                  src="../assets/images/logo/ZentihZone.png"
                  alt="ZenithZone logo"
                  class="h-16 sm:h-20"
                />
              </a>

              <!-- Search Field For Large Device -->
              <div class="flex-grow mx-10 my-2 sm:my-0 hidden md:block">
                <div class="relative">
                  <input
                    type="search"
                    name="search"
                    class="w-full pl-4 pr-20 py-2 border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border rounded-md"
                    placeholder="Enter your product name..."
                  />
                  <!-- Search Button -->
                  <button
                    class="absolute inset-y-0 right-10 px-3 flex items-center"
                  >
                    <ion-icon
                      name="search-outline"
                      class="h-5 w-5 text-gray-500"
                    ></ion-icon>
                  </button>
                  <!-- Voice Search Button -->
                  <button
                    class="absolute inset-y-0 right-0 px-3 flex items-center"
                  >
                    <ion-icon
                      name="mic-outline"
                      class="h-5 w-5 text-gray-500"
                    ></ion-icon>
                  </button>
                </div>
              </div>

              <!-- User Actions and Authentication -->
              <div class="flex items-center space-x-4 mt-2 sm:mt-0">
                <!-- Authentication Links -->
                <a
                  href="../Login/Login.php"
                  class="text-gray-500 hover:text-gray-700 transition duration-150 ease-in-out"
                  >Login</a
                >
                <a
                  href="../Registration/Who.php"
                  class="text-gray-500 hover:text-gray-700 transition duration-150 ease-in-out"
                  >Register</a
                >

                <!-- User Actions -->
                <button class="text-gray-500 hover:text-gray-700">
                  <ion-icon name="person-outline" class="h-6 w-6"></ion-icon>
                </button>
                <button class="relative text-gray-500 hover:text-gray-700">
                  <ion-icon name="heart-outline" class="h-6 w-6"></ion-icon>
                  <span
                    class="absolute -top-2 -right-2 rounded-full bg-red-500 text-white text-xs px-2 py-1"
                    >0</span
                  >
                </button>
                <button class="relative text-gray-500 hover:text-gray-700">
                  <ion-icon
                    name="bag-handle-outline"
                    class="h-6 w-6"
                  ></ion-icon>
                  <span
                    class="absolute -top-2 -right-2 rounded-full bg-red-500 text-white text-xs px-2 py-1"
                    >0</span
                  >
                </button>
              </div>
              <!-- Search Field for Small device  -->
              <div class="flex-grow mx-10 my-2 sm:my-0 block sm:hidden">
                <div class="relative">
                  <input
                    type="search"
                    name="search"
                    class="w-full pl-4 pr-20 py-2 border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border rounded-md"
                    placeholder="Enter your product name..."
                  />
                  <!-- Search Button -->
                  <button
                    class="absolute inset-y-0 right-10 px-3 flex items-center"
                  >
                    <ion-icon
                      name="search-outline"
                      class="h-5 w-5 text-gray-500"
                    ></ion-icon>
                  </button>
                  <!-- Voice Search Button -->
                  <button
                    class="absolute inset-y-0 right-0 px-3 flex items-center"
                  >
                    <ion-icon
                      name="mic-outline"
                      class="h-5 w-5 text-gray-500"
                    ></ion-icon>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Second nav -->
      <nav
        class="bg-gradient-to-r from-indigo-500 from-10% via-sky-500 via-30% to-emerald-500 to-90% hidden fixed top-[120px] sm:block w-full z-40"
      >
        <div class="container mx-auto px-4 py-3">
          <ul
            class="flex flex-wrap justify-center items-center gap-6 lg:gap-8 xl:gap-10"
          >
            <li>
              <a href="#" class="text-slate-50 font-bold hover:text-indigo-500"
                >Home</a
              >
            </li>
            <li class="dropdown dropdown-hover">
              <div
                tabindex="0"
                role="button"
                class="text-slate-50 font-bold hover:text-indigo-500"
              >
                Categories
              </div>
              <ul
                tabindex="0"
                class="dropdown-content menu bg-base-100 rounded-box z-50 min-w-96 p-4 shadow grid grid-cols-2 md:grid-cols-4 gap-4"
              >
                <div>
                  <h3 class="font-semibold mb-2">Electronics</h3>
                  <ul class="space-y-1">
                    <li>
                      <a href="#" class="text-gray-600 hover:text-indigo-500"
                        >Desktop</a
                      >
                    </li>
                    <li>
                      <a href="#" class="text-gray-600 hover:text-indigo-500"
                        >Laptop</a
                      >
                    </li>
                    <li>
                      <a href="#" class="text-gray-600 hover:text-indigo-500"
                        >Camera</a
                      >
                    </li>
                    <li>
                      <a href="#" class="text-gray-600 hover:text-indigo-500"
                        >Tablet</a
                      >
                    </li>
                    <li>
                      <a href="#" class="text-gray-600 hover:text-indigo-500"
                        >Headphone</a
                      >
                    </li>
                  </ul>
                </div>
                <div>
                  <h3 class="font-semibold mb-2">Men's</h3>
                  <ul class="space-y-1">
                    <li>
                      <a href="#" class="text-gray-600 hover:text-indigo-500"
                        >Formal</a
                      >
                    </li>
                    <li>
                      <a href="#" class="text-gray-600 hover:text-indigo-500"
                        >Casual</a
                      >
                    </li>
                    <li>
                      <a href="#" class="text-gray-600 hover:text-indigo-500"
                        >Sports</a
                      >
                    </li>
                    <li>
                      <a href="#" class="text-gray-600 hover:text-indigo-500"
                        >Jacket</a
                      >
                    </li>
                    <li>
                      <a href="#" class="text-gray-600 hover:text-indigo-500"
                        >Sunglasses</a
                      >
                    </li>
                  </ul>
                </div>
                <div>
                  <h3 class="font-semibold mb-2">Women's</h3>
                  <ul class="space-y-1">
                    <li>
                      <a href="#" class="text-gray-600 hover:text-indigo-500"
                        >Formal</a
                      >
                    </li>
                    <li>
                      <a href="#" class="text-gray-600 hover:text-indigo-500"
                        >Casual</a
                      >
                    </li>
                    <li>
                      <a href="#" class="text-gray-600 hover:text-indigo-500"
                        >Perfume</a
                      >
                    </li>
                    <li>
                      <a href="#" class="text-gray-600 hover:text-indigo-500"
                        >Cosmetics</a
                      >
                    </li>
                    <li>
                      <a href="#" class="text-gray-600 hover:text-indigo-500"
                        >Bags</a
                      >
                    </li>
                  </ul>
                </div>
                <div>
                  <h3 class="font-semibold mb-2">Accessories</h3>
                  <ul class="space-y-1">
                    <li>
                      <a href="#" class="text-gray-600 hover:text-indigo-500"
                        >Smart Watch</a
                      >
                    </li>
                    <li>
                      <a href="#" class="text-gray-600 hover:text-indigo-500"
                        >Smart TV</a
                      >
                    </li>
                    <li>
                      <a href="#" class="text-gray-600 hover:text-indigo-500"
                        >Keyboard</a
                      >
                    </li>
                    <li>
                      <a href="#" class="text-gray-600 hover:text-indigo-500"
                        >Mouse</a
                      >
                    </li>
                    <li>
                      <a href="#" class="text-gray-600 hover:text-indigo-500"
                        >Microphone</a
                      >
                    </li>
                  </ul>
                </div>
              </ul>
            </li>
            <li class="dropdown dropdown-hover">
              <div
                tabindex="0"
                role="button"
                class="text-slate-50 font-bold hover:text-indigo-500"
              >
                Art or Craft
              </div>
              <ul
                tabindex="0"
                class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow"
              >
                <li>
                  <a href="#" class="text-gray-600 hover:text-indigo-500"
                    >Shirt</a
                  >
                </li>
                <li>
                  <a href="#" class="text-gray-600 hover:text-indigo-500"
                    >Shorts & Jeans</a
                  >
                </li>
                <li>
                  <a href="#" class="text-gray-600 hover:text-indigo-500"
                    >Safety Shoes</a
                  >
                </li>
                <li>
                  <a href="#" class="text-gray-600 hover:text-indigo-500"
                    >Wallet</a
                  >
                </li>
              </ul>
            </li>
            <li class="dropdown dropdown-hover">
              <div
                tabindex="0"
                role="button"
                class="text-slate-50 font-bold hover:text-indigo-500"
              >
                Second Hand Products
              </div>
              <ul
                tabindex="0"
                class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow"
              >
                <li>
                  <a href="#" class="text-gray-600 hover:text-indigo-500"
                    >Shirt</a
                  >
                </li>
                <li>
                  <a href="#" class="text-gray-600 hover:text-indigo-500"
                    >Shorts & Jeans</a
                  >
                </li>
                <li>
                  <a href="#" class="text-gray-600 hover:text-indigo-500"
                    >Safety Shoes</a
                  >
                </li>
                <li>
                  <a href="#" class="text-gray-600 hover:text-indigo-500"
                    >Wallet</a
                  >
                </li>
              </ul>
            </li>
            <li class="dropdown dropdown-hover">
              <div
                tabindex="0"
                role="button"
                class="text-slate-50 font-bold hover:text-indigo-500"
              >
                Men's
              </div>
              <ul
                tabindex="0"
                class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow"
              >
                <li>
                  <a href="#" class="text-gray-600 hover:text-indigo-500"
                    >Shirt</a
                  >
                </li>
                <li>
                  <a href="#" class="text-gray-600 hover:text-indigo-500"
                    >Shorts & Jeans</a
                  >
                </li>
                <li>
                  <a href="#" class="text-gray-600 hover:text-indigo-500"
                    >Safety Shoes</a
                  >
                </li>
                <li>
                  <a href="#" class="text-gray-600 hover:text-indigo-500"
                    >Wallet</a
                  >
                </li>
              </ul>
            </li>
            <li class="dropdown dropdown-hover">
              <div
                tabindex="0"
                role="button"
                class="text-slate-50 font-bold hover:text-indigo-500"
              >
                Women's
              </div>
              <ul
                tabindex="0"
                class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow"
              >
                <li>
                  <a href="#" class="text-gray-600 hover:text-indigo-500"
                    >Dress & Frock</a
                  >
                </li>
                <li>
                  <a href="#" class="text-gray-600 hover:text-indigo-500"
                    >Earrings</a
                  >
                </li>
                <li>
                  <a href="#" class="text-gray-600 hover:text-indigo-500"
                    >Necklace</a
                  >
                </li>
                <li>
                  <a href="#" class="text-gray-600 hover:text-indigo-500"
                    >Makeup Kit</a
                  >
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>

      <!-- Nav ber for mobile version  -->
      <div
        class="fixed inset-x-0 bottom-0 bg-white shadow-lg p-2 z-50 flex justify-around items-center sm:hidden"
      >
        <div class="relative">
          <div class="dropdown dropdown-top dropdown-hover">
            <div tabindex="0" role="button" class="btn m-1 btn-ghost">
              <ion-icon name="menu-outline" class="text-2xl"></ion-icon>
            </div>
            <ul
              tabindex="0"
              class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow"
            >
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
          <span class="badge badge-sm badge-error absolute -top-1 -right-1"
            >0</span
          >
        </button>

        <button class="btn btn-ghost">
          <ion-icon name="home-outline" class="text-2xl"></ion-icon>
        </button>

        <button class="btn btn-ghost relative">
          <ion-icon name="heart-outline" class="text-2xl"></ion-icon>
          <span class="badge badge-sm badge-error absolute -top-1 -right-1"
            >0</span
          >
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
      <div
        class="carousel w-10/12 mx-auto overflow-hidden rounded-lg mt-2 flex mt-48"
      >
        <!-- Slide 1 -->
        <div
          id="slide1"
          class="carousel-item relative w-full h-72 transition duration-3000"
        >
          <img
            src="../assets/images/Art.jpg"
            alt="Art and Craft"
            class="w-full"
          />
          <div
            class="banner-content absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between items-center"
          >
            <a href="#slide3" class="btn btn-circle">❮</a>
            <div class="text-center">
              <h2 class="banner-title text-white text-xl md:text-3xl">
                See All Creative Art Works
              </h2>
            </div>
            <a href="#slide2" class="btn btn-circle">❯</a>
          </div>
          <div class="absolute bottom-5 left-1/2 transform -translate-x-1/2">
            <a href="#" class="btn btn-primary">Explore</a>
          </div>
        </div>

        <!-- Slide 2 -->
        <div
          id="slide2"
          class="carousel-item relative w-full h-72 transition duration-3000"
        >
          <img
            src="../assets/images/OldMobile.jpg"
            alt="Second hand Product"
            class="w-full"
          />
          <div
            class="banner-content absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between items-center"
          >
            <a href="#slide1" class="btn btn-circle">❮</a>
            <div class="text-center">
              <h2 class="banner-title text-white text-xl md:text-3xl">
                Buy Second Hand Products
              </h2>
            </div>
            <a href="#slide3" class="btn btn-circle">❯</a>
          </div>
          <div class="absolute bottom-5 left-1/2 transform -translate-x-1/2">
            <a href="#" class="btn btn-primary">Explore</a>
          </div>
        </div>

        <!-- Slide 3 -->
        <div
          id="slide3"
          class="carousel-item relative w-full h-72 transition duration-3000"
        >
          <img
            src="../assets/images/banner-3.jpg"
            alt="new fashion summer sale"
            class="w-full"
          />
          <div
            class="banner-content absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between items-center"
          >
            <a href="#slide2" class="btn btn-circle">❮</a>
            <div class="text-center">
              <h2 class="banner-title text-white text-xl md:text-3xl">
                New fashion summer
              </h2>
            </div>
            <a href="#slide1" class="btn btn-circle">❯</a>
          </div>
          <div class="absolute bottom-5 left-1/2 transform -translate-x-1/2">
            <a href="#" class="btn btn-primary">Explore</a>
          </div>
        </div>
      </div>
      <!--
      - CATEGORY
    -->

      <!--
      - PRODUCT
    -->

      <!-- This Product container  -->
      <div class="container mx-auto px-4">
        <div class="flex flex-col">
          <!-- Product Main -->
          <div class="text-center py-6">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">New Products</h2>
            <div
              class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6"
            >
              <!-- Product Showcase -->

              <!-- 1st Product -->
              <div
                class="bg-white shadow-lg rounded-lg overflow-hidden relative group hover:border-red-500 hover:border-2 transition duration-300 w-48"
              >
                <img
                  src="../assets/images/products/jacket-1.jpg"
                  alt="Mens Jacket"
                  class="w-full h-32 object-cover transition duration-300 ease-in-out"
                />
                <div
                  class="absolute inset-y-0 right-0 flex flex-col items-center justify-center gap-2 transform translate-x-full transition-transform duration-300 ease-in-out group-hover:translate-x-0 bg-black bg-opacity-0 p-2"
                >
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
                  <a
                    href="#"
                    class="inline-block text-blue-500 hover:text-blue-600 text-sm"
                    >JACKET</a
                  >
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
              <div
                class="bg-white shadow-lg rounded-lg overflow-hidden relative group hover:border-red-500 hover:border-2 transition duration-300 w-48"
              >
                <img
                  src="../assets/images/products/clothes-1.jpg"
                  alt="Mens Jacket"
                  class="w-full h-32 object-cover transition duration-300 ease-in-out"
                />
                <div
                  class="absolute inset-y-0 right-0 flex flex-col items-center justify-center gap-2 transform translate-x-full transition-transform duration-300 ease-in-out group-hover:translate-x-0 bg-black bg-opacity-0 p-2"
                >
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
                  <a
                    href="#"
                    class="inline-block text-blue-500 hover:text-blue-600 text-sm"
                    >JACKET</a
                  >
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
              <div
                class="bg-white shadow-lg rounded-lg overflow-hidden relative group hover:border-red-500 hover:border-2 transition duration-300 w-48"
              >
                <img
                  src="../assets/images/products/watch-2.jpg"
                  alt="Mens Watch"
                  class="w-full h-32 object-cover transition duration-300 ease-in-out"
                />
                <div
                  class="absolute inset-y-0 right-0 flex flex-col items-center justify-center gap-2 transform translate-x-full transition-transform duration-300 ease-in-out group-hover:translate-x-0 bg-black bg-opacity-0 p-2"
                >
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
                  <a
                    href="#"
                    class="inline-block text-blue-500 hover:text-blue-600 text-sm"
                    >JACKET</a
                  >
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
              <div
                class="bg-white shadow-lg rounded-lg overflow-hidden relative group hover:border-red-500 hover:border-2 transition duration-300 w-48"
              >
                <img
                  src="../assets/images/products/jewellery-2.jpg"
                  alt="Beautiful Jewellery"
                  class="w-full h-32 object-cover transition duration-300 ease-in-out"
                />
                <div
                  class="absolute inset-y-0 right-0 flex flex-col items-center justify-center gap-2 transform translate-x-full transition-transform duration-300 ease-in-out group-hover:translate-x-0 bg-black bg-opacity-0 p-2"
                >
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
                  <a
                    href="#"
                    class="inline-block text-blue-500 hover:text-blue-600 text-sm"
                    >Jewellery</a
                  >
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
              <div
                class="bg-white shadow-lg rounded-lg overflow-hidden relative group hover:border-red-500 hover:border-2 transition duration-300 w-48"
              >
                <img
                  src="../assets/images/products/shoe-3.jpg"
                  alt="Beautiful Jewellery"
                  class="w-full h-32 object-cover transition duration-300 ease-in-out"
                />
                <div
                  class="absolute inset-y-0 right-0 flex flex-col items-center justify-center gap-2 transform translate-x-full transition-transform duration-300 ease-in-out group-hover:translate-x-0 bg-black bg-opacity-0 p-2"
                >
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
                  <a
                    href="#"
                    class="inline-block text-blue-500 hover:text-blue-600 text-sm"
                    >MAN SHOES</a
                  >
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
              <div
                class="bg-white shadow-lg rounded-lg overflow-hidden relative group hover:border-red-500 hover:border-2 transition duration-300 w-48"
              >
                <img
                  src="../assets/images/products/clothes-1.jpg"
                  alt="Mens Jacket"
                  class="w-full h-32 object-cover transition duration-300 ease-in-out"
                />
                <div
                  class="absolute inset-y-0 right-0 flex flex-col items-center justify-center gap-2 transform translate-x-full transition-transform duration-300 ease-in-out group-hover:translate-x-0 bg-black bg-opacity-0 p-2"
                >
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
                  <a
                    href="#"
                    class="inline-block text-blue-500 hover:text-blue-600 text-sm"
                    >JACKET</a
                  >
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
        <img
          src="../assets/images/payment.png"
          alt="payment method"
          class="mx-auto mb-4"
        />
        <p class="text-gray-400">
          Copyright &copy; ZentihZone All Rights Reserved.
        </p>
      </div>
    </footer>

    <!--
    - custom js link
  -->
    <script src="./background.js"></script>

    <!--
    - ionicon link
  -->
    <script
      type="module"
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"
    ></script>
  </body>
</html>