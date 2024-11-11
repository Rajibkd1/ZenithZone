<!-- add_products.php -->
<div class="section">
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
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Submit
            </button>
        </div>
    </form>
</div>
