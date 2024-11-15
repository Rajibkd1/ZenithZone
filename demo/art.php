<form id="artBiddingForm">
    <h1 class="text-center font-bold text-black text-xl">Create an Art Bidding</h1>

    <div class="mt-8">
        <label class="text-gray-800 text-xs block mb-2">Artwork Name</label>
        <div class="relative flex items-center">
            <input id="artworkName" name="artworkName" type="text" required class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" placeholder="Enter artwork name" />
        </div>
    </div>

    <div class="mt-8">
        <label class="text-gray-800 text-xs block mb-2">Artist Name</label>
        <div class="relative flex items-center">
            <input id="artistName" name="artistName" type="text" required class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" placeholder="Enter artist name" />
        </div>
    </div>

    <div class="mt-8">
        <label class="text-gray-800 text-xs block mb-2">Minimum Bidding Price</label>
        <div class="relative flex items-center">
            <input id="minBiddingPrice" name="minBiddingPrice" type="number" required class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" placeholder="Enter bidding price" />
        </div>
    </div>

    <div class="mt-8">
        <label class="text-gray-800 text-xs block mb-2">Bid Increment</label>
        <div class="relative flex items-center">
            <input id="bidIncrement" name="bidIncrement" type="number" required class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" placeholder="Enter increment amount" />
        </div>
    </div>

    <div class="mt-8">
        <label class="text-gray-800 text-xs block mb-2">Bidding End Date</label>
        <input type="date" id="endDate" name="endDate" class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" required>
    </div>

    <div class="mt-8">
        <label class="text-gray-800 text-xs block mb-2">Interest (e.g., Commission %)</label>
        <input type="number" step="0.01" id="interest" name="interest" class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" placeholder="e.g., 10%" required>
    </div>

    <div class="mt-8">
        <label class="text-gray-800 text-xs block mb-2">Description</label>
        <textarea id="description" name="description" class="w-full bg-transparent text-sm text-gray-800 border-b border-gray-300 focus:border-blue-500 px-2 py-3 outline-none" rows="3" placeholder="Enter description" required></textarea>
    </div>

    <div class="mt-8 text-center">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Submit for Bidding
        </button>
    </div>
</form>

<script src="art.js">
  </script>