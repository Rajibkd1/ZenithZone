document.getElementById('couponForm').addEventListener('submit', function(event) {
    event.preventDefault();  // Prevent form submission

    // Clear any previous error message
    const errorMessage = document.getElementById('errorMessage');
    errorMessage.classList.add('hidden');

    let valid = true;

    // Validate Coupon Name
    const couponName = document.getElementById('couponName');
    if (!couponName.value.trim()) {
        valid = false;
    }

    // Validate Discount Percentage (1 to 100)
    const discountPercentage = document.getElementById('discountPercentage');
    if (!discountPercentage.value || discountPercentage.value <= 0 || discountPercentage.value > 100) {
        valid = false;
    }

    // Validate Dates
    const startDate = document.getElementById('startDate');
    const endDate = document.getElementById('endDate');
    const start = new Date(startDate.value);
    const end = new Date(endDate.value);

    if (!startDate.value || !endDate.value || start >= end) {
        valid = false;
    }

    // Validate Occasion selection
    const occasion = document.getElementById('occasion');
    if (!occasion.value) {
        valid = false;
    }

    // If validation fails, show error; if valid, alert success
    if (valid) {
        alert("Coupon created successfully!");
        // document.getElementById('couponForm').submit(); // Uncomment for actual form submission
    } else {
        errorMessage.classList.remove('hidden');
    }
});
