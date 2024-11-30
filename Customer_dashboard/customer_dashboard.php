<?php
session_start();
$userId = isset($_GET['user_id']) ? $_GET['user_id'] : null;
$userType = isset($_GET['user_type']) ? $_GET['user_type'] : null;
include"../Database_Connection/DB_Connection.php";

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <title>Animated Sidebar Menu HTML CSS | CodingNepal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const menuBtn = document.getElementById('btn');
            const content = document.querySelector('.content');

            // Close sidebar if clicked outside of the sidebar
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 1023 && menuBtn.checked && !sidebar.contains(event.target) && !menuBtn.contains(event.target)) {
                    menuBtn.checked = false; // Uncheck to close the sidebar
                }
            });

            // Prevent the click from closing the sidebar if clicked inside the sidebar
            sidebar.addEventListener('click', function(event) {
                event.stopPropagation(); // Prevent click from propagating to the document
            });

            // Add event listeners for dynamic content loading
            const buttons = document.querySelectorAll('.sidebar-button');

            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const action = this.dataset.action; // Get the action from the data-action attribute
                    loadContent(action); // Load content dynamically
                });
            });

            // Edit Profile Button Event Listener
            const editProfileButton = document.getElementById('editProfileButton');
            if (editProfileButton) {
                editProfileButton.addEventListener('click', function() {
                    loadContent('edit_profile'); // Trigger content load for edit_profile
                });
            }
        });

        // Function to load content dynamically via AJAX
        function loadContent(action) {
            let url = '';
            const userId = <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'null'; ?>; // Get user_id from session

            switch (action) {
                case 'profile':
                    url = 'profile.php?user_id=' + userId; // Load profile page
                    break;
                case 'edit_profile':
                    url = 'edit_profile.php?user_id=' + userId; // Load edit profile page
                    break;
                case 'home':
                    url = 'Cart.php'; // URL to load home content
                    break;
                case 'clients':
                    url = 'edit_profile.php?user_id=' + userId; // Load edit profile page
                    break;
                case 'services':
                    url = 'services.php'; // URL to load services content
                    break;
                case 'settings':
                    url = 'settings.php'; // URL to load settings content
                    break;
                case 'features':
                    url = 'features.php'; // URL to load features content
                    break;
                case 'logout':
                    window.location.href = 'logout.php'; // Redirect to logout
                    return;
                default:
                    url = 'default.php'; // Default content
            }

            // Send AJAX request to load content
            const xhr = new XMLHttpRequest();
            xhr.open('GET', url, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.querySelector('.content').innerHTML = xhr.responseText;
                } else {
                    document.querySelector('.content').innerHTML = 'Failed to load content';
                }
            };
            xhr.send();
        }
    </script>
</head>

<body class="bg-gray-200 font-poppins">
    <div class="wrapper relative">
        <!-- Hidden checkbox to control sidebar toggle -->
        <input type="checkbox" id="btn" class="hidden" />

        <!-- Menu button -->
        <label for="btn" class="menu-btn absolute left-5 top-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white h-12 w-12 flex items-center justify-center rounded-full cursor-pointer border border-gray-700 transition-all duration-300 transform hover:scale-110 hover:shadow-lg active:scale-95">
            <i class="fas fa-bars text-xl"></i>
            <i class="fas fa-times text-xl opacity-0 transition-all duration-300"></i>
        </label>

        <!-- Sidebar -->
        <nav id="sidebar" class="fixed bg-gray-700 h-full w-64 left-[-270px] transition-all duration-300">
            <div class="flex justify-center title text-center text-white text-3xl font-semibold py-5 bg-gradient-to-r from-blue-600 to-indigo-700 border-b border-gray-900">
                <a href="<?php echo isset($_SESSION['loggedin']) && $_SESSION['loggedin'] ? '../HomePage/Personalized_products.php' : '../HomePage/InitialPage1.php'; ?>" class="flex-shrink-0">
                    <img src="../assets/images/logo/ZenithZone.png" alt="ZenithZone logo" class="h-20 sm:h-24" />
                </a>
            </div>
            <ul class="list-items">
                <li class="py-4 pl-10 border-t border-b border-gray-800 transition-all duration-300 hover:bg-indigo-600 hover:text-white rounded-md hover:shadow-lg transform hover:scale-105 sidebar-button" data-action="profile">
                    <a href="#" class="text-white text-lg font-medium flex items-center space-x-4">
                        <i class="fas fa-user-circle text-xl"></i>
                        <span>Profile</span>
                    </a>
                </li>

                <li class="py-4 pl-10 border-t border-b border-gray-800 transition-all duration-300 hover:bg-indigo-600 hover:text-white rounded-md hover:shadow-lg transform hover:scale-105 sidebar-button" data-action="home">
                    <a href="#" class="text-white text-lg font-medium flex items-center space-x-4">
                        <i class="fas fa-home text-xl"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="py-4 pl-10 border-t border-b border-gray-800 transition-all duration-300 hover:bg-indigo-600 hover:text-white rounded-md hover:shadow-lg transform hover:scale-105 sidebar-button" data-action="clients">
                    <a href="#" class="text-white text-lg font-medium flex items-center space-x-4">
                        <i class="fas fa-sliders-h text-xl"></i>
                        <span>Clients</span>
                    </a>
                </li>
                <li class="py-4 pl-10 border-t border-b border-gray-800 transition-all duration-300 hover:bg-indigo-600 hover:text-white rounded-md hover:shadow-lg transform hover:scale-105 sidebar-button" data-action="services">
                    <a href="#" class="text-white text-lg font-medium flex items-center space-x-4">
                        <i class="fas fa-address-book text-xl"></i>
                        <span>Services</span>
                    </a>
                </li>
                <li class="py-4 pl-10 border-t border-b border-gray-800 transition-all duration-300 hover:bg-indigo-600 hover:text-white rounded-md hover:shadow-lg transform hover:scale-105 sidebar-button" data-action="settings">
                    <a href="#" class="text-white text-lg font-medium flex items-center space-x-4">
                        <i class="fas fa-cog text-xl"></i>
                        <span>Settings</span>
                    </a>
                </li>
                <li class="py-4 pl-10 border-t border-b border-gray-800 transition-all duration-300 hover:bg-indigo-600 hover:text-white rounded-md hover:shadow-lg transform hover:scale-105 sidebar-button" data-action="features">
                    <a href="#" class="text-white text-lg font-medium flex items-center space-x-4">
                        <i class="fas fa-stream text-xl"></i>
                        <span>Features</span>
                    </a>
                </li>

                <!-- Logout Button at the bottom -->
                <li class="mt-auto py-4 pl-10 border-t border-b border-gray-800 transition-all duration-300 hover:bg-red-600 hover:text-white rounded-md hover:shadow-lg transform hover:scale-105 sidebar-button" data-action="logout">
                    <a href="#" class="text-white text-lg font-medium flex items-center space-x-4">
                        <i class="fas fa-sign-out-alt text-xl"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Content -->
    <div class="content absolute left-16 sm:left-0 ">
        <h1>Welcome! Please select a menu item.</h1>
    </div>


</body>

</html>