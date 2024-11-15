const commissionData = {
    1: {
        productName: "Art Piece #1",
        productType: "Art/Bidding",
        sellerName: "John Doe",
        commissionAmount: "$200",
        status: "Pending",
        date: "2024-08-25",
        description: "This artwork has a pending commission, waiting for approval."
    }
};

// Function to show commission details in modal
function viewCommissionDetails(id) {
    const details = commissionData[id];
    
    if (details) {
        // Populate modal content with specific details
        const modalContent = `
            <p><strong>Product Name:</strong> ${details.productName}</p>
            <p><strong>Product Type:</strong> ${details.productType}</p>
            <p><strong>Seller Name:</strong> ${details.sellerName}</p>
            <p><strong>Commission Amount:</strong> ${details.commissionAmount}</p>
            <p><strong>Status:</strong> ${details.status}</p>
            <p><strong>Date:</strong> ${details.date}</p>
            <p><strong>Description:</strong> ${details.description}</p>
        `;
        
        document.getElementById("commissionDetailsContent").innerHTML = modalContent;
        
        // Show the modal
        document.getElementById("commissionDetailsModal").classList.remove("hidden");
    } else {
        console.error("Error: Commission details not found for ID:", id);
        document.getElementById("commissionDetailsContent").innerHTML = "<p>Error: Commission details not found.</p>";
    }
}

// Function to close the modal
function closeCommissionDetails() {
    document.getElementById("commissionDetailsModal").classList.add("hidden");
}