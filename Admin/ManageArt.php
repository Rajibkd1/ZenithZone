<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Art Gallery - Pending Approval</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #eef2f7 100%);
        }

        h1, h2 {
            font-family: 'Playfair Display', serif;
        }

        .art-gallery-header {
            background-image: url('/api/placeholder/1200/300');
            background-size: cover;
            background-position: center;
        }

        .table-container {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
            overflow: hidden;
        }

        .btn-view {
            transition: all 0.3s ease;
        }

        .btn-view:hover {
            transform: translateY(-2px);
        }

        .art-details-card {
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .hidden {
            display: none !important;
        }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-pending {
            background-color: #FEF3C7;
            color: #92400E;
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }
    </style>
</head>

<body class="min-h-screen bg-gray-50">
    <!-- Decorative Header -->
    <div class="art-gallery-header relative h-48 w-full flex items-center justify-center mb-6">
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>
        <div class="relative z-10 text-center">
            <h1 class="text-4xl font-bold text-white mb-2">Art Gallery</h1>
            <p class="text-gray-200 text-lg">Admin Approval Dashboard</p>
        </div>
    </div>

    <div class="container mx-auto px-4 md:px-6 pb-12">
        <!-- Page header with stats -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Pending Approvals</h2>
                <p class="text-gray-600 mt-1">Review and approve new artwork submissions</p>
            </div>
            
            <div class="flex space-x-4 mt-4 md:mt-0">
                <div class="bg-white rounded-lg p-4 shadow-sm flex flex-col items-center justify-center w-32">
                    <span class="text-sm text-gray-500">Pending</span>
                    <span class="text-2xl font-bold text-amber-500">5</span>
                </div>
                <div class="bg-white rounded-lg p-4 shadow-sm flex flex-col items-center justify-center w-32">
                    <span class="text-sm text-gray-500">Approved</span>
                    <span class="text-2xl font-bold text-green-500">28</span>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="table-container bg-white rounded-xl overflow-hidden">
            <?php
            include "../Database_Connection/DB_Connection.php";

            $query = "SELECT * FROM art_gallery WHERE approval_status = 'pending'";
            $result = $conn->query($query);

            if ($result && $result->num_rows > 0): ?>
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-800 text-left text-gray-100">
                        <th class="py-4 px-6">#</th>
                        <th class="py-4 px-6">Art Name</th>
                        <th class="py-4 px-6">Artist ID</th>
                        <th class="py-4 px-6">Initial Price</th>
                        <th class="py-4 px-6">Date Posted</th>
                        <th class="py-4 px-6">Status</th>
                        <th class="py-4 px-6">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 1;
                    while ($row = $result->fetch_assoc()): ?>
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                        <td class="py-4 px-6"><?php echo $count++; ?></td>
                        <td class="py-4 px-6 font-medium"><?php echo htmlspecialchars($row['art_name']); ?></td>
                        <td class="py-4 px-6"><?php echo htmlspecialchars($row['artist_id']); ?></td>
                        <td class="py-4 px-6 font-medium"><?php echo number_format(htmlspecialchars($row['art_init_price'])); ?> BDT</td>
                        <td class="py-4 px-6"><?php echo htmlspecialchars($row['creation_date']); ?></td>
                        <td class="py-4 px-6">
                            <span class="status-badge status-pending">Pending</span>
                        </td>
                        <td class="py-4 px-6">
                            <button class="bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 
                            transition-all btn-view flex items-center space-x-1" data-id="<?php echo $row['art_id']; ?>">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <span>View</span>
                            </button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <?php else: ?>
            <div class="py-16 flex flex-col items-center justify-center">
                <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <p class="text-gray-500 text-lg">No artwork pending approval</p>
                <p class="text-gray-400 text-sm mt-1">All submissions have been processed</p>
            </div>
            <?php endif; ?>

            <?php $conn->close(); ?>
        </div>

        <!-- Art details section -->
        <div id="art-details" class="mt-8 hidden fade-in">
            <div class="art-details-card bg-white p-6 rounded-xl">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-bold text-gray-800">Art Details</h2>
                    <button id="close-details" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div id="art-info" class="mt-4">
                    <div class="flex justify-center">
                        <div class="animate-pulse flex space-x-4">
                            <div class="rounded-full bg-gray-200 h-10 w-10"></div>
                            <div class="flex-1 space-y-4 py-1">
                                <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                                <div class="space-y-2">
                                    <div class="h-4 bg-gray-200 rounded"></div>
                                    <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        $(document).ready(function () {
            let artId;

            // Show art details when "View" button is clicked
            $('.btn-view').click(function () {
                artId = $(this).data('id');
                $('#art-details').removeClass('hidden'); // Show art details section
                $('#art-info').html(`
                    <div class="flex justify-center">
                        <div class="animate-pulse flex space-x-4">
                            <div class="rounded-full bg-gray-200 h-10 w-10"></div>
                            <div class="flex-1 space-y-4 py-1">
                                <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                                <div class="space-y-2">
                                    <div class="h-4 bg-gray-200 rounded"></div>
                                    <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                `); // Show loading animation

                // Fetch art details using AJAX
                $.ajax({
                    url: './Art_details.php',
                    type: 'GET',
                    data: { id: artId },
                    success: function (data) {
                        $('#art-info').html(data); // Populate art details
                        $('#approval-buttons').removeClass('hidden'); // Show approval buttons
                    },
                    error: function () {
                        $('#art-info').html('<div class="bg-red-50 text-red-500 p-4 rounded-lg">Failed to fetch art details. Please try again later.</div>');
                    }
                });
            });
            
            // Close art details
            $('#close-details').click(function() {
                $('#art-details').addClass('hidden');
                $('#approval-buttons').addClass('hidden');
            });
        });
    </script>
</body>

</html>