<form id="secondHandProductFormElement">
    <h1 class="text-center font-bold text-black text-xl">Sell a Second Hand Product</h1>

    <div class="mt-8">
        <label class="text-gray-800 text-xs block mb-2">Product Name</label>
        <input id="fname" name="fname" type="text" required class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" placeholder="Enter Product name">
    </div>

    <div class="mt-8">
        <label class="text-gray-800 text-xs block mb-2">Location</label>
        <input id="location" name="location" type="text" required class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" placeholder="Enter the location">
    </div>

    <div class="mt-8">
        <label class="text-gray-800 text-xs block mb-2">Selling Price</label>
        <input id="sellingPrice" name="selling_price" type="number" required class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" placeholder="Enter the selling price">
    </div>

    <div class="mt-8">
        <label class="text-gray-800 text-xs block mb-2">Original Price</label>
        <input id="originalPrice" name="original_price" type="number" required class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" placeholder="Enter the original price">
    </div>

    <div class="mt-4">
        <label class="text-gray-800 text-xs block mb-2">Condition</label>
        <select name="condition" required class="w-full bg-transparent text-xs font-medium text-gray-800 border-b border-gray-300 focus:border-blue-500 px-3 py-2 outline-none">
            <option value="" disabled selected>Select Condition</option>
            <option value="Like New">Like New</option>
            <option value="Good">Good</option>
            <option value="Acceptable">Acceptable</option>
        </select>
    </div>

    <div class="mt-8">
        <label class="text-gray-800 text-xs block mb-2">Original Purchase Date</label>
        <input type="date" name="purchase_date" required class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none">
    </div>

    <div class="mt-8">
        <label for="reasonForSelling" class="text-gray-800 text-xs block mb-2">Reason for Selling</label>
        <textarea id="reasonForSelling" name="reason_for_selling" required class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" rows="2" placeholder="Enter reason"></textarea>
    </div>

    <div class="mt-8">
    <label class="text-gray-800 text-xs block mb-2">Category</label>
    <div class="flex items-center gap-4">
        <label class="flex items-center cursor-pointer text-xs font-medium text-gray-800">
            <input type="radio" name="category" value="Men" class="hidden peer" />
            <span class="w-5 h-5 inline-block mr-2 rounded-full border-2 border-gray-300 peer-checked:border-blue-500 peer-checked:bg-blue-500 transition-colors duration-200 ease-in-out flex items-center justify-center">
                <svg class="hidden w-3 h-3 text-white peer-checked:block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <circle cx="12" cy="12" r="12"/>
                </svg>
            </span>
            Men
        </label>
        <label class="flex items-center cursor-pointer text-xs font-medium text-gray-800">
            <input type="radio" name="category" value="Women" class="hidden peer" />
            <span class="w-5 h-5 inline-block mr-2 rounded-full border-2 border-gray-300 peer-checked:border-blue-500 peer-checked:bg-blue-500 transition-colors duration-200 ease-in-out flex items-center justify-center">
                <svg class="hidden w-3 h-3 text-white peer-checked:block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <circle cx="12" cy="12" r="12"/>
                </svg>
            </span>
            Women
        </label>
        <label class="flex items-center cursor-pointer text-xs font-medium text-gray-800">
            <input type="radio" name="category" value="Kids" class="hidden peer" />
            <span class="w-5 h-5 inline-block mr-2 rounded-full border-2 border-gray-300 peer-checked:border-blue-500 peer-checked:bg-blue-500 transition-colors duration-200 ease-in-out flex items-center justify-center">
                <svg class="hidden w-3 h-3 text-white peer-checked:block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <circle cx="12" cy="12" r="12"/>
                </svg>
            </span>
            Kids
        </label>
        <label class="flex items-center cursor-pointer text-xs font-medium text-gray-800">
            <input type="radio" name="category" value="Others" class="hidden peer" />
            <span class="w-5 h-5 inline-block mr-2 rounded-full border-2 border-gray-300 peer-checked:border-blue-500 peer-checked:bg-blue-500 transition-colors duration-200 ease-in-out flex items-center justify-center">
                <svg class="hidden w-3 h-3 text-white peer-checked:block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <circle cx="12" cy="12" r="12"/>
                </svg>
            </span>
            Others
        </label>
    </div>
</div>


    <div class="mt-8">
        <label class="text-gray-800 text-xs block mb-2">Product Picture</label>
        <input id="own-picture" name="own_picture" type="file" required class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none">
    </div>

    <div class="mt-8">
        <label class="text-gray-800 text-xs block mb-2">
            <input type="checkbox" id="termsAndConditions" required class="form-checkbox text-indigo-600">
            <span class="ml-2">I agree to the terms and conditions</span>
        </label>
    </div>

    <div class="mt-8 text-center">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">Submit</button>
    </div>
</form>


<!-- JavaScript Code -->
<script src="second.js"></script>
