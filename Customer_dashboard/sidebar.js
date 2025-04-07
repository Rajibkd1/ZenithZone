// Enhanced sidebar.js
$(document).ready(function() {
    // Add loading animation function
    function showLoading() {
        $('#content').html('<div class="loading"></div>');
    }

    // Track active menu item
    function setActive(element) {
        $('.sidebar-button').removeClass('active');
        $(element).addClass('active');
    }

    // Enhanced content loading with animations
    function loadContent(page, button) {
        setActive(button);
        showLoading();
        
        // Close sidebar on mobile after menu selection
        if ($(window).width() < 1024) {
            $('#btn').prop('checked', false);
        }
        
        $.ajax({
            url: page,
            type: 'GET',
            success: function(response) {
                // Fade out loading, then fade in content
                $('#content').fadeOut(200, function() {
                    $(this).html(response).fadeIn(300);
                });
            },
            error: function() {
                $('#content').fadeOut(200, function() {
                    $(this).html(`
                        <div class="text-center py-10">
                            <i class="fas fa-exclamation-circle text-red-500 text-5xl mb-4"></i>
                            <p class="text-xl font-medium">Error loading content</p>
                            <p class="text-gray-600 mt-2">Please try again later</p>
                        </div>
                    `).fadeIn(300);
                });
            }
        });
    }

    // Menu item click handlers with enhanced functionality
    $('#profile-btn').click(function() {
        loadContent('profile.php', this);
    });
    
    $('#wallet-btn').click(function() {
        loadContent('customer_wallet.php', this);
    });
    
    $('#my-cart-btn').click(function() {
        loadContent('Cart.php', this);
    });
    
    $('#my-wishlist-btn').click(function() {
        loadContent('Wishlist.php', this);
    });
    
    $('#my-orders-btn').click(function() {
        loadContent('Orderlist.php', this);
    });
    
    $('#my-reviews-btn').click(function() {
        loadContent('CompleteOrder.php', this);
    });
    
    $('#my-arts-btn').click(function() {
        loadContent('myArtList.php', this);
    });

    // Special handling for logout - no AJAX loading
    $('#logout-btn').click(function() {
        setActive(this);
        // Let the natural link behavior occur
    });

    // Style welcome message on initial load
    if ($('#content').text().trim() === "Welcome to your dashboard!") {
        $('#content').html(`
            <div class="text-center py-8">
                <div class="mb-6">
                    <i class="fas fa-paint-brush text-5xl text-indigo-600 mb-4"></i>
                    <h1 class="text-3xl font-bold text-gray-800">Welcome to ZenithZone</h1>
                    <p class="text-gray-600 mt-2">Your creative art marketplace</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all">
                        <i class="fas fa-user-circle text-3xl text-indigo-500 mb-3"></i>
                        <h3 class="text-xl font-semibold">Manage Profile</h3>
                        <p class="text-gray-600 mt-2">Update your personal information</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all">
                        <i class="fas fa-shopping-cart text-3xl text-indigo-500 mb-3"></i>
                        <h3 class="text-xl font-semibold">Browse Products</h3>
                        <p class="text-gray-600 mt-2">Discover amazing artworks</p>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all">
                        <i class="fas fa-palette text-3xl text-indigo-500 mb-3"></i>
                        <h3 class="text-xl font-semibold">Sell Your Art</h3>
                        <p class="text-gray-600 mt-2">Share your creativity with the world</p>
                    </div>
                </div>
            </div>
        `);
    }

    // Add page load transition effect
    $('body').css('opacity', 0).animate({opacity: 1}, 500);
});