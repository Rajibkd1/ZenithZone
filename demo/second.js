document.getElementById('secondHandProductFormElement').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission
    
    // Get form values
    const productName = document.getElementById('fname').value;
    const location = document.getElementById('location').value;
    const sellingPrice = document.getElementById('sellingPrice').value;
    const originalPrice = document.getElementById('originalPrice').value;
    const condition = document.querySelector('select[name="condition"]').value;
    const purchaseDate = document.querySelector('input[name="purchase_date"]').value;
    const reasonForSelling = document.getElementById('reasonForSelling').value;
    const category = document.querySelector('input[name="category"]:checked'); // Updated to get the checked radio button
    const termsAccepted = document.getElementById('termsAndConditions').checked;

    // Basic validation
    if (!termsAccepted) {
        alert("You must accept the terms and conditions to proceed.");
        return;
    }

    // Validate selling and original price (must be numbers and not empty)
    if (sellingPrice === "" || isNaN(sellingPrice)) {
        alert("Please enter a valid selling price.");
        return;
    }
    if (originalPrice === "" || isNaN(originalPrice)) {
        alert("Please enter a valid original price.");
        return;
    }

    // Check if category is selected
    if (!category) {
        alert("Please select a category.");
        return;
    }

    // Log form data to console (this is where you could also send data to a server)
    console.log({
        productName: productName,
        location: location,
        sellingPrice: sellingPrice,
        originalPrice: originalPrice,
        condition: condition,
        purchaseDate: purchaseDate,
        reasonForSelling: reasonForSelling,
        category: category.value, // Get the value of the selected category
        termsAccepted: termsAccepted
    });

    // Reset the form after submission
    this.reset();
});
