// Function to show the selected section and hide others
function showSection(sectionId) {
    const sections = document.querySelectorAll('.section');
    sections.forEach(section => {
        section.classList.add('hidden');
    });
    document.getElementById(sectionId).classList.remove('hidden');
}

// On page load, show the dashboard section by default(submit button)
document.addEventListener('DOMContentLoaded', function() {
    showSection('dashboard');
});

document.addEventListener('DOMContentLoaded', function() {
    const submitButton = document.getElementById('submitButton');

    // Function to handle form submission
    submitButton.addEventListener('click', function() {
        const selectedCategory = document.querySelector('input[name="category"]:checked');

        if (selectedCategory) {
            alert(`Form submitted with category: ${selectedCategory.value}`);
            // Perform further actions, like sending the data to a server
        } else {
            alert('Please select a category before submitting.');
        }
    });
});

function showSection(sectionId) {
    const sections = document.querySelectorAll('.section');
    sections.forEach(section => section.classList.add('hidden'));

    const targetSection = document.getElementById(sectionId);
    if (targetSection) {
        targetSection.classList.remove('hidden');
    }
}

// Event listener for the Second Hand Product form submission
document.getElementById('secondHandProductFormElement').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission
    
    // You can add logic to handle the form submission, like sending the data to a server or performing validation.
    console.log('Second-Hand Product form submitted');

    // For now, just reset the form
    this.reset();
});
//coupon 
document.addEventListener('DOMContentLoaded', function() {
    const couponForm = document.querySelector('#new-coupon form');

    couponForm.addEventListener('submit', function(event) {
        event.preventDefault();

        // Example: Capturing form data
        const couponName = couponForm.querySelector('input[type="text"]').value;
        const discount = couponForm.querySelector('input[type="number"]').value;
        const startDate = couponForm.querySelector('input[type="date"]:nth-child(3)').value;
        const endDate = couponForm.querySelector('input[type="date"]:nth-child(4)').value;
        const occasion = couponForm.querySelector('select').value;
        const description = couponForm.querySelector('textarea').value;

        console.log(`Coupon Name: ${couponName}`);
        console.log(`Discount: ${discount}%`);
        console.log(`Start Date: ${startDate}`);
        console.log(`End Date: ${endDate}`);
        console.log(`Occasion: ${occasion}`);
        console.log(`Description: ${description}`);

        // Here, you can send the data to the server or perform any other action.
    });
});

//modify product
document.getElementById("modifySubmitButton").addEventListener("click", function(event) {
    event.preventDefault(); // Prevent default form submission

    const product = document.querySelector("#modify-product select").value;
    const stockStatus = document.querySelector("#modify-product select").value;
    const discount = document.querySelector("#modify-product input").value;
    const offers = document.querySelector("#modify-product textarea").value;

    if (!product) {
        alert("Please select a product.");
        return;
    }

    

    alert(`Product ${product} has been updated with stock status: ${stockStatus}, discount: ${discount}%, and offers: ${offers}`);
});


document.querySelectorAll("#order-manage select").forEach(selectElement => {
    selectElement.addEventListener("change", function(event) {
        const orderId = this.closest("tr").querySelector("td:first-child").textContent;
        const newStatus = this.value;

        // Perform your logic here, such as sending the status update to the server
        alert(`Order ${orderId} status updated to ${newStatus}`);
    });
});

//Art & Bidding 
function showSection(sectionId) {
    const sections = document.querySelectorAll('.section');
    sections.forEach(section => section.classList.add('hidden'));
    document.getElementById(sectionId).classList.remove('hidden');
}

//process commision
// Function to show commission details modal
document.addEventListener('DOMContentLoaded', function() {
    function viewCommissionDetails(commissionId) {
        // Assuming you'd load details dynamically based on the commissionId
        // Example: Load content into the modal's content area
        document.getElementById('commissionDetailsContent').innerHTML = `<p>Details for Commission ID: ${commissionId}</p>`;
        
        // Show the modal
        document.getElementById('commissionDetailsModal').classList.remove('hidden');
    }

    function closeCommissionDetails() {
        // Hide the modal
        document.getElementById('commissionDetailsModal').classList.add('hidden');
    }

    // Making the functions available globally for inline event handlers
    window.viewCommissionDetails = viewCommissionDetails;
    window.closeCommissionDetails = closeCommissionDetails;
});
