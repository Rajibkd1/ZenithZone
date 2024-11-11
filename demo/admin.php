<?php
// Include the database connection file
include 'connection.php';

// Now you can use $conn to interact with the database

// Example: Check if the connection is working
// if ($conn) {
//     echo "Connected to the Admin database successfully!";
// } else {
//     echo "Failed to connect to the Admin database.";
// }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>ZenithZone Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex flex-col md:flex-row min-h-screen">
        <!-- Sidebar -->
        <div class="bg-blue-900 text-white w-full md:w-64 lg:w-64 p-4">
            <div class="mb-8">
                <img src="./image/logo.png" alt="ZenithZone Logo" class="h-16 mx-auto">
            </div>
            <button onclick="showSection('dashboard')" class="w-full text-left p-4 mb-2 bg-blue-700 hover:bg-blue-800 rounded">Dashboard</button>
            <button onclick="showSection('add-products')" class="w-full text-left p-4 mb-2 bg-blue-700 hover:bg-blue-800 rounded">Add Products</button>
            <button onclick="showSection('modify-product')" class="w-full text-left p-4 mb-2 bg-blue-700 hover:bg-blue-800 rounded">Product Status</button>
            <button onclick="showSection('new-coupon')" class="w-full text-left p-4 mb-2 bg-blue-700 hover:bg-blue-800 rounded">Coupon</button>
            <button onclick="showSection('second-product')" class="w-full text-left p-4 mb-2 bg-blue-700 hover:bg-blue-800 rounded">Second Hand Product</button>
            <button onclick="showSection('art-bidding')" class="w-full text-left p-4 mb-2 bg-blue-700 hover:bg-blue-800 rounded">Art Bidding</button>
            <button onclick="showSection('process-commission')" class="w-full text-left p-4 mb-2 bg-blue-700 hover:bg-blue-800 rounded">Process Commission</button>
            <button onclick="showSection('order-manage')" class="w-full text-left p-4 mb-2 bg-blue-700 hover:bg-blue-800 rounded">Order Manage</button>
        </div>
        <!-- Content Area -->
        <div class="w-full md:w-3/4 lg:w-4/5 p-8">
            <!-- Dashboard Section -->
            <div id="dashboard" class="section hidden">
                <h1 class="text-3xl font-bold mb-4">Dashboard</h1>
                <p>This is the dashboard overview.</p>
            </div>

            <!-- Add Products Section -->
            <div id="add-products" class="section hidden">
                <h1 class="text-3xl font-bold mb-4">Create A New Product</h1>
                <form>
                    <div class="mb-4">
                        <label class="block text-gray-700">Name</label>
                        <input type="text" class="w-full p-2 border border-gray-300 rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Code</label>
                        <input type="text" class="w-full p-2 border border-gray-300 rounded">
                    </div>
                    <div class="mb-4 flex flex-col md:flex-row">
                        <div class="w-full md:w-1/2 md:pr-2">
                            <label class="block text-gray-700">Price</label>
                            <input type="text" class="w-full p-2 border border-gray-300 rounded">
                        </div>
                        <div class="w-full md:w-1/2 md:pl-2 mt-4 md:mt-0">
                            <label class="block text-gray-700">Weight</label>
                            <input type="text" class="w-full p-2 border border-gray-300 rounded">
                        </div>
                    </div>
                    <div class="mt-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                        <div class="flex items-center">
                            <label class="inline-flex items-center mr-4">
                                <input type="radio" name="category" value="Men" class="form-radio text-blue-600" />
                                <span class="ml-2">Men</span>
                            </label>
                            <label class="inline-flex items-center mr-4">
                                <input type="radio" name="category" value="Women" class="form-radio text-blue-600" />
                                <span class="ml-2">Women</span>
                            </label>
                            <label class="inline-flex items-center mr-4">
                                <input type="radio" name="category" value="Kids" class="form-radio text-blue-600" />
                                <span class="ml-2">Kids</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="category" value="Others" class="form-radio text-blue-600" />
                                <span class="ml-2">Others</span>
                            </label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Description</label>
                        <textarea class="w-full p-2 border border-gray-300 rounded"></textarea>
                    </div>
                    <div class="mt-6">
                        <button id="submitButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Submit
                        </button>
                    </div>
                </form>
            </div>

            <!-- Second Hand Product Section -->
            <div id="second-product" class="section hidden">
                <h1 class="text-3xl font-bold mb-4">Sell a Second Hand Product</h1>
                <form>
                    <div class="mb-4">
                        <label class="block text-gray-700">Product Name</label>
                        <input type="text" class="w-full p-2 border border-gray-300 rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Location</label>
                        <input type="text" class="w-full p-2 border border-gray-300 rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Selling Price</label>
                        <input type="text" class="w-full p-2 border border-gray-300 rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Orginal Price</label>
                        <input type="text" class="w-full p-2 border border-gray-300 rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Condition</label>
                        <select class="w-full p-2 border border-gray-300 rounded">
                            <option>Like New</option>
                            <option>Good</option>
                            <option>Acceptable</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Original Purchase Date</label>
                        <input type="text" placeholder="dd/mm/yyyy" class="w-full p-2 border border-gray-300 rounded">
                    </div>
                    <div class="mb-4">
                        <label for="reasonForSelling" class="block text-sm font-medium text-gray-700">Reason for Selling</label>
                        <textarea id="reasonForSelling" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" rows="2" required></textarea>
                    </div>
                    <div class="mt-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                        <div class="flex items-center">
                            <label class="inline-flex items-center mr-4">
                                <input type="radio" name="category" value="Men" class="form-radio text-blue-600" />
                                <span class="ml-2">Men</span>
                            </label>
                            <label class="inline-flex items-center mr-4">
                                <input type="radio" name="category" value="Women" class="form-radio text-blue-600" />
                                <span class="ml-2">Women</span>
                            </label>
                            <label class="inline-flex items-center mr-4">
                                <input type="radio" name="category" value="Kids" class="form-radio text-blue-600" />
                                <span class="ml-2">Kids</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="category" value="Others" class="form-radio text-blue-600" />
                                <span class="ml-2">Others</span>
                            </label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Description</label>
                        <textarea class="w-full p-2 border border-gray-300 rounded"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Upload Images</label>
                        <input type="file" multiple class="w-full p-2 border border-gray-300 rounded">
                    </div>
                    <div class="mb-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" id="termsAndConditions" class="form-checkbox text-indigo-600" required>
                            <span class="ml-2">I agree to the terms and conditions</span>
                        </label>
                    </div>
            
                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md shadow-sm">Submit</button>
                    </div>
                </form>
            </div>

            <!-- coupon -->
            <div id="new-coupon" class="section hidden">
                <h1 class="text-3xl font-bold mb-4">Create A New Coupon</h1>
                <form>
                    <div class="mb-4">
                        <label class="block text-gray-700">Coupon Name</label>
                        <input type="text" class="w-full p-2 border border-gray-300 rounded" placeholder="E.g., Mother's Day Discount">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Discount Percentage</label>
                        <input type="number" class="w-full p-2 border border-gray-300 rounded" placeholder="E.g., 20">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Start Date</label>
                        <input type="date" class="w-full p-2 border border-gray-300 rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">End Date</label>
                        <input type="date" class="w-full p-2 border border-gray-300 rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Occasion</label>
                        <select class="w-full p-2 border border-gray-300 rounded">
                            <option value="mother's day">Mother's Day</option>
                            <option value="women's day">Women's Day</option>
                            <option value="eid">Eid</option>
                            <option value="puja">Puja</option>
                            <option value="christmas">Christmas</option>
                            <option value="new year">New Year</option>
                            <option value="black friday">Black Friday</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Description</label>
                        <textarea class="w-full p-2 border border-gray-300 rounded" placeholder="Add any additional details"></textarea>
                    </div>
                    <div class="mt-6">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
            <!-- Modify Product Section -->
<div id="modify-product" class="section hidden">
    <h1 class="text-3xl font-bold mb-4"> Product Status</h1>
    <form>
        <div class="mb-4">
            <label class="block text-gray-700">Select Product</label>
            <select class="w-full p-2 border border-gray-300 rounded">
                <option value="">Select a product</option>
                <option value="product1">Product 1</option>
                <option value="product2">Product 2</option>
                <!-- Add more products as needed -->
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Stock Status</label>
            <select class="w-full p-2 border border-gray-300 rounded">
                <option value="in-stock">In Stock</option>
                <option value="out-of-stock">Out of Stock</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Apply Discount</label>
            <input type="text" placeholder="Enter discount percentage" class="w-full p-2 border border-gray-300 rounded">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Special Offers</label>
            <textarea placeholder="Enter any special offers or promotions" class="w-full p-2 border border-gray-300 rounded"></textarea>
        </div>

        <div class="mt-6">
            <button id="modifySubmitButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Update Product
            </button>
        </div>
    </form>
</div>
<!-- Art Bidding Section -->
<div id="art-bidding" class="section hidden">
    <h1 class="text-3xl font-bold mb-4">Create an Art Bidding</h1>
    <form method="POST" action="process_art_bidding.php">
        <div class="mb-4">
            <label class="block text-gray-700">Artwork Name</label>
            <input type="text" name="artwork_name" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Artist Name</label>
            <input type="text" name="artist_name" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Minimum Bidding Price</label>
            <input type="number" name="min_bid_price" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Bid Increment</label>
            <input type="number" name="bid_increment" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Bidding End Date</label>
            <input type="date" name="end_date" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Interest (e.g., Commission %)</label>
            <input type="number" step="0.01" name="interest" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Description</label>
            <textarea name="description" class="w-full p-2 border border-gray-300 rounded" required></textarea>
        </div>
        <div class="mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Submit for Bidding
            </button>
        </div>
    </form>
</div>
<!--process commissiom-->
<div id="process-commission" class="section hidden">
    <h1 class="text-3xl font-bold mb-4">Process Commission</h1>

    <!-- Filter and Search -->
    <div class="mb-4 flex justify-between">
        <div>
            <select id="commissionFilter" class="p-2 border border-gray-300 rounded">
                <option value="all">All</option>
                <option value="completed">Completed</option>
                <option value="pending">Pending</option>
            </select>
        </div>
        <div>
            <input type="text" id="commissionSearch" placeholder="Search by Product or Seller" class="p-2 border border-gray-300 rounded">
        </div>
    </div>

    <!-- Commission List -->
    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Product Name</th>
                <th class="py-2 px-4 border-b">Product Type</th>
                <th class="py-2 px-4 border-b">Seller Name</th>
                <th class="py-2 px-4 border-b">Commission Amount</th>
                <th class="py-2 px-4 border-b">Status</th>
                <th class="py-2 px-4 border-b">Date</th>
                <th class="py-2 px-4 border-b">Action</th>
            </tr>
        </thead>
        <tbody id="commissionList">
            <!-- Example Row -->
            <tr>
                <td class="py-2 px-4 border-b">Art Piece #1</td>
                <td class="py-2 px-4 border-b">Art/Bidding</td>
                <td class="py-2 px-4 border-b">John Doe</td>
                <td class="py-2 px-4 border-b">$200</td>
                <td class="py-2 px-4 border-b">Pending</td>
                <td class="py-2 px-4 border-b">2024-08-25</td>
                <td class="py-2 px-4 border-b">
                    <button onclick="viewCommissionDetails(1)" class="text-blue-500 hover:underline">View Details</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Commission Details Modal -->
<div id="commissionDetailsModal" class="fixed inset-0 hidden z-50 bg-black bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Commission Details</h2>
        <div id="commissionDetailsContent">
            <!-- Dynamic Content Here -->
            <p>Commission details will be displayed here...</p>
        </div>
        <button onclick="closeCommissionDetails()" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Close</button>
    </div>
</div>


<!-- Order Manage Section -->
<div id="order-manage" class="section hidden">
    <h1 class="text-3xl font-bold mb-4">Order Management</h1>

    <!-- Order List Table -->
    <table class="w-full text-left table-auto border-collapse">
        <thead>
            <tr>
                <th class="border-b p-4">Order ID</th>
                <th class="border-b p-4">Customer</th>
                <th class="border-b p-4">Date</th>
                <th class="border-b p-4">Total</th>
                <th class="border-b p-4">Status</th>
                <th class="border-b p-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Example Order Row -->
            <tr>
                <td class="border-b p-4">12345</td>
                <td class="border-b p-4">John Doe</td>
                <td class="border-b p-4">16/08/2024</td>
                <td class="border-b p-4">$100.00</td>
                <td class="border-b p-4">
                    <select class="p-2 border border-gray-300 rounded">
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="shipped">Shipped</option>
                        <option value="delivered">Delivered</option>
                        <option value="canceled">Canceled</option>
                    </select>
                </td>
                <td class="border-b p-4">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View Details</button>
                </td>
            </tr>
            <!-- Repeat rows for more orders -->
            <tr>
                <td class="border-b p-4">12345</td>
                <td class="border-b p-4">John Doe</td>
                <td class="border-b p-4">16/08/2024</td>
                <td class="border-b p-4">$100.00</td>
                <td class="border-b p-4">
                    <select class="p-2 border border-gray-300 rounded">
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="shipped">Shipped</option>
                        <option value="delivered">Delivered</option>
                        <option value="canceled">Canceled</option>
                    </select>
                </td>
                <td class="border-b p-4">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View Details</button>
                </td>
            </tr>
            <tr>
                <td class="border-b p-4">12345</td>
                <td class="border-b p-4">John Doe</td>
                <td class="border-b p-4">16/08/2024</td>
                <td class="border-b p-4">$100.00</td>
                <td class="border-b p-4">
                    <select class="p-2 border border-gray-300 rounded">
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="shipped">Shipped</option>
                        <option value="delivered">Delivered</option>
                        <option value="canceled">Canceled</option>
                    </select>
                </td>
                <td class="border-b p-4">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View Details</button>
                </td>
            </tr>
            <tr>
                <td class="border-b p-4">12345</td>
                <td class="border-b p-4">John Doe</td>
                <td class="border-b p-4">16/08/2024</td>
                <td class="border-b p-4">$100.00</td>
                <td class="border-b p-4">
                    <select class="p-2 border border-gray-300 rounded">
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="shipped">Shipped</option>
                        <option value="delivered">Delivered</option>
                        <option value="canceled">Canceled</option>
                    </select>
                </td>
                <td class="border-b p-4">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View Details</button>
                </td>
            </tr>
            <tr>
                <td class="border-b p-4">12345</td>
                <td class="border-b p-4">John Doe</td>
                <td class="border-b p-4">16/08/2024</td>
                <td class="border-b p-4">$100.00</td>
                <td class="border-b p-4">
                    <select class="p-2 border border-gray-300 rounded">
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="shipped">Shipped</option>
                        <option value="delivered">Delivered</option>
                        <option value="canceled">Canceled</option>
                    </select>
                </td>
                <td class="border-b p-4">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View Details</button>
                </td>
            </tr>
            <tr>
                <td class="border-b p-4">12345</td>
                <td class="border-b p-4">John Doe</td>
                <td class="border-b p-4">16/08/2024</td>
                <td class="border-b p-4">$100.00</td>
                <td class="border-b p-4">
                    <select class="p-2 border border-gray-300 rounded">
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="shipped">Shipped</option>
                        <option value="delivered">Delivered</option>
                        <option value="canceled">Canceled</option>
                    </select>
                </td>
                <td class="border-b p-4">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View Details</button>
                </td>
            </tr>
            <tr>
                <td class="border-b p-4">12345</td>
                <td class="border-b p-4">John Doe</td>
                <td class="border-b p-4">16/08/2024</td>
                <td class="border-b p-4">$100.00</td>
                <td class="border-b p-4">
                    <select class="p-2 border border-gray-300 rounded">
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="shipped">Shipped</option>
                        <option value="delivered">Delivered</option>
                        <option value="canceled">Canceled</option>
                    </select>
                </td>
                <td class="border-b p-4">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">View Details</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
         




            
        </div>
    </div>
    
    <script src="admin.js"></script>
</body>
</html>
