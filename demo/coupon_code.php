<form id="couponForm">
    <h1 class="text-center font-bold text-black text-xl">Create A New Coupon</h1>

    <!-- Coupon Name -->
    <div class="mb-4">
        <label class="text-gray-800 text-xs block mb-2">Coupon Name</label>
        <input id="couponName" name="couponName" type="text" required class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" placeholder="E.g., Mother's Day Discount">
    </div>

    <!-- Discount Percentage -->
    <div class="mb-4">
        <label class="text-gray-800 text-xs block mb-2">Discount Percentage</label>
        <input id="discountPercentage" name="discountPercentage" type="number" required class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" placeholder="E.g., 20" min="1" max="100">
    </div>

    <!-- Start Date -->
    <div class="mb-4">
        <label class="text-gray-800 text-xs block mb-2">Start Date</label>
        <input id="startDate" name="startDate" type="date" required class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none">
    </div>

    <!-- End Date -->
    <div class="mb-4">
        <label class="text-gray-800 text-xs block mb-2">End Date</label>
        <input id="endDate" name="endDate" type="date" required class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none">
    </div>

    <!-- Occasion -->
    <div class="mb-4">
        <label class="text-gray-800 text-xs block mb-2">Occasion</label>
        <select id="occasion" name="occasion" required class="w-full bg-transparent text-xs font-medium text-gray-800 px-3 py-2 border-b border-gray-300 focus:border-blue-500 outline-none transition duration-200 ease-in-out">
            <option value="" disabled selected>Select Occasion</option>
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

    <!-- Description -->
    <div class="mb-4">
        <label class="text-gray-800 text-xs block mb-2">Description</label>
        <textarea id="description" name="description" class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" placeholder="Add any additional details"></textarea>
    </div>

    <!-- Submit Button -->
    <div class="mt-6">
        <button type="submit" id="submitBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Submit
        </button>
    </div>

    <!-- Error Message Display -->
    <div id="errorMessage" class="text-red-500 text-center mt-4 hidden">Please fill out all fields correctly!</div>
</form>

<script src="coupon.js">
  </script>