<?php
session_start();
include "../Database_Connection/DB_Connection.php";
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <title>Dynamic Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery for AJAX -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-gray-200 font-poppins">
    <div class="wrapper relative">
        <!-- Hidden checkbox for sidebar toggle -->
        <input type="checkbox" id="btn" class="hidden" />

        <!-- Menu Button -->
        <label for="btn" class="menu-btn absolute left-5 top-3 bg-blue-500 text-white h-12 w-12 flex items-center justify-center rounded-full cursor-pointer">
            <i class="fas fa-bars"></i>
        </label>

        <!-- Sidebar -->
        <nav id="sidebar" class="fixed bg-gray-700 h-full w-64 left-[-270px] transition-all duration-300">
            <div class="flex justify-center text-white text-3xl font-semibold py-5 bg-gradient-to-r from-blue-600 to-indigo-700">
                ZenithZone
            </div>
            <ul class="list-items">
                <li class="py-4 pl-10 sidebar-button" id="profile-btn">
                    <a href="javascript:void(0);" class="text-white text-lg flex items-center">
                        <i class="fas fa-user-circle"></i>
                        <span class="ml-4">Profile</span>
                    </a>
                </li>
                <li class="py-4 pl-10 sidebar-button" id="my-cart-btn">
                    <a href="javascript:void(0);" class="text-white text-lg flex items-center">
                        <i class="fas fa-shopping-cart"></i> <!-- Icon for the cart -->
                        <span class="ml-4">My Cart</span>
                    </a>
                </li>
                <li class="py-4 pl-10 sidebar-button" id="my-wishlist-btn">
                    <a href="javascript:void(0);" class="text-white text-lg flex items-center">
                        <i class="fas fa-heart"></i> <!-- Icon for the wishlist -->
                        <span class="ml-4">My Wishlist</span>
                    </a>
                </li>
                <li class="py-4 pl-10 sidebar-button" id="home-btn">
                    <a href="javascript:void(0);" class="text-white text-lg flex items-center">
                        <i class="fas fa-home"></i>
                        <span class="ml-4">Home</span>
                    </a>
                </li>
                <!-- Add more menu items as needed -->
            </ul>
        </nav>
    </div>

    <!-- Content Area -->
    <div class="content p-10" id="content">
        <!-- Default content or message can be shown here initially -->
        <?php
        echo "Welcome to your dashboard!";
        ?>
    </div>
    <script src="./sidebar.js"></script>
    <script>
        $(document).ready(function() {
            // When profile button is clicked
            $('#profile-btn').click(function() {
                loadContent('profile.php');
            });

            // When edit-profile button is clicked
            $('#my-cart-btn').click(function() {
                loadContent('Cart.php');
            });
            // When edit-profile button is clicked
            $('#my-wishlist-btn').click(function() {
                loadContent('Wishlist.php');
            });

            // When home button is clicked
            $('#home-btn').click(function() {
                loadContent('../HomePage/Personalized_products.php');
            });

            // Function to load content via AJAX
            function loadContent(page) {
                $.ajax({
                    url: page, // The page to load (e.g., profile.php)
                    type: 'GET',
                    success: function(response) {
                        $('#content').html(response); // Replace the content in #content div with the response
                    },
                    error: function() {
                        $('#content').html('<p>Error loading content.</p>');
                    }
                });
            }
        });
    </script>

</body>

</html>