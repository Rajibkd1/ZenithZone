document.getElementById('productForm').addEventListener('submit', function(event) {
    event.preventDefault();  // Prevent the form from submitting if validation fails

    // Clear any previous error message
    const errorMessage = document.getElementById('errorMessage');
    errorMessage.classList.add('hidden');

    let valid = true;

    // Check if product is selected
    const productSelect = document.getElementById('productSelect');
    if (!productSelect.value) {
        valid = false;
    }

    // Check if product status is selected
    const productStatus = document.getElementById('productStatus');
    if (!productStatus.value) {
        valid = false;
    }

    // Check if discount is a valid positive number
    const discount = document.getElementById('discount');
    if (!discount.value || discount.value <= 0) {
        valid = false;
    }

    // Check if special offer is provided
    const specialOffer = document.getElementById('specialOffer');
    if (!specialOffer.value) {
        valid = false;
    }

    if (valid) {
        // If the form is valid, show a success message or submit
        alert("Form submitted successfully!");
        // You can now proceed to submit the form if needed (e.g., using AJAX or form submission)
        // document.getElementById('productForm').submit(); // Uncomment to submit the form
    } else {
        // If validation fails, show an error message
        errorMessage.classList.remove('hidden');
    }
});
