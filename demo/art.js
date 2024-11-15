document.getElementById("artBiddingForm").addEventListener("submit", function(event) {
    event.preventDefault();  // Prevent form from submitting normally

    // Capture form data
    const artworkName = document.getElementById("artworkName").value;
    const artistName = document.getElementById("artistName").value;
    const minBiddingPrice = document.getElementById("minBiddingPrice").value;
    const bidIncrement = document.getElementById("bidIncrement").value;
    const endDate = document.getElementById("endDate").value;
    const interest = document.getElementById("interest").value;
    const description = document.getElementById("description").value;

    // Display the data in console (for testing purposes)
    console.log("Artwork Name:", artworkName);
    console.log("Artist Name:", artistName);
    console.log("Minimum Bidding Price:", minBiddingPrice);
    console.log("Bid Increment:", bidIncrement);
    console.log("End Date:", endDate);
    console.log("Interest:", interest);
    console.log("Description:", description);

    // Here, you could submit the data via an AJAX request or handle further validation
    alert("Form submitted successfully!");
});
