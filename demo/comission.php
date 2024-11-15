<form id="commissionForm" class="bg-transparent p-6 rounded-lg shadow-lg">
    <h1 class="text-center font-bold text-black text-xl mb-4">Process Commission</h1>

    <div class="mb-4 flex justify-between">
        <div>
            <select id="commissionFilter" class="p-2 border border-gray-300 rounded bg-transparent text-gray-800">
                <option value="all">All</option>
                <option value="completed">Completed</option>
                <option value="pending">Pending</option>
            </select>
        </div>
        <div>
            <input type="text" id="commissionSearch" placeholder="Search by Product or Seller" class="p-2 border border-gray-300 rounded bg-transparent text-gray-800">
        </div>
    </div>

    <!-- Commission List -->
    <table class="min-w-full bg-transparent border border-gray-300 text-gray-800">
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
</form>

<!-- Commission Details Modal -->
<div id="commissionDetailsModal" class="fixed inset-0 hidden z-50 bg-black bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-80">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Commission Details</h2>
        <div id="commissionDetailsContent" class="text-gray-800">
            <!-- Placeholder for Dynamic Content -->
            <p>Commission details will be displayed here...</p>
        </div>
        <button onclick="closeCommissionDetails()" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Close</button>
    </div>
</div>





<script src="comission.js">
    </script>