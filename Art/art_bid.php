<?php

include '../Database_Connection/DB_Connection.php'; // Ensure this is correctly pointing to your connection script

// Get the art ID from the URL query parameter
$artId = isset($_GET['artId']) ? intval($_GET['artId']) : 0;

if ($artId === 0) {
    echo "Invalid art ID!";
    exit;
}

// Fetch art details using the art ID
$query = "SELECT art_name, art_description, art_img, final_bid_price, previous_bid_price, art_init_price, bid_end_date FROM art_gallery WHERE art_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $artId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "No art found!";
    exit;
}

// Determine the current bid price
if ($row['previous_bid_price'] === null || $row['previous_bid_price'] == 0) {
    $currentBidPrice = $row['art_init_price'];
} else {
    $currentBidPrice = $row['previous_bid_price'];
}

$bidEndDate = $row['bid_end_date'];

// Check if bidding has ended
$hasBiddingEnded = (new DateTime() > new DateTime($bidEndDate));

// Handle bid submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['bid_amount'])) {
    $newBid = (float)$_POST['bid_amount'];

    // Ensure the new bid is higher than the current bid or initial price
    if ($newBid > $currentBidPrice && !$hasBiddingEnded) {
        // Update the previous_bid_price in the database
        $updateQuery = "UPDATE art_gallery SET previous_bid_price = ? WHERE art_id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("di", $newBid, $artId);
        if ($stmt->execute()) {
            // Refresh the current bid price after successful update
            $currentBidPrice = $newBid;
        } else {
            $error = "Error updating bid: " . $conn->error;
        }
    } else {
        $error = "Your bid must be higher than the current bid price or bidding has ended.";
    }
}

// If bidding has ended, update the final bid price
if ($hasBiddingEnded && $row['final_bid_price'] != $currentBidPrice) {
    // Update final bid price
    $updateQuery = "UPDATE art_gallery SET final_bid_price = previous_bid_price WHERE art_id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("i", $artId);
    $stmt->execute();

    // Refresh the current bid price
    $currentBidPrice = $row['previous_bid_price'];
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZenithZone</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.min.css" rel="stylesheet" type="text/css">
    <style>
        .card {
            transition: transform 0.3s ease-in-out;
        }
        .card:hover {
            transform: scale(1.05);
        }
        /* Fullscreen image container styles */
        .fullscreen-img-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(0, 0, 0, 0.9);
            z-index: 1000;
        }
        /* Fullscreen image styles */
        .fullscreen-img {
            max-width: 90%;
            max-height: 90%;
            border-radius: 8px;
            object-fit: contain;
        }
        /* Timer styles */
        #countdown {
            font-size: 1.5rem;
            font-weight: bold;
            color: #e53e3e; /* Red color */
            background-color: #f7fafc; /* Light background color */
            padding: 10px;
            border-radius: 8px;
            display: inline-block;
        }
        #countdown-container {
            text-align: center;
            margin-top: 10px;
            font-size: 1.25rem;
        }
    </style>
    <script>
        // Function to calculate and display the countdown
        function startCountdown(endTime) {
            const countdownElement = document.getElementById('countdown');

            function updateCountdown() {
                const now = new Date().getTime();
                const distance = endTime - now;

                if (distance > 0) {
                    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    countdownElement.innerHTML = days + "d " + hours + "h "
                        + minutes + "m " + seconds + "s ";
                } else {
                    countdownElement.innerHTML = "Bidding Time is Over";
                    document.getElementById('placeBidButton').style.display = 'none';
                    document.getElementById('bidForm').style.display = 'none';
                }
            }

            updateCountdown();
            setInterval(updateCountdown, 1000);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const bidEndDate = new Date("<?php echo $bidEndDate; ?>").getTime();
            startCountdown(bidEndDate);
        });
    </script>
</head>
<?php
include"../Header_Footer/fixed_header.php";
?>

<body class="bg-gray-100 flex flex-col justify-center min-h-screen">
<div class="flex-grow flex flex-col justify-center items-center mt-36 w-full">
<div id="cardContainer" class="card bg-white shadow-lg rounded-lg p-6 max-w-4xl mx-auto">
    <div class="flex justify-center">
        <img src="<?php echo htmlspecialchars($row['art_img']); ?>" alt="Artwork" class="rounded-lg w-56 h-64 cursor-pointer" id="artImage" onclick="toggleFullscreenImage()">
    </div>
    <h2 class="text-3xl font-bold my-4 text-center"><?php echo htmlspecialchars($row['art_name']); ?></h2>
    <p class="text-gray-600 text-center"><?php echo htmlspecialchars($row['art_description']); ?></p>
    <p class="text-lg font-semibold mt-3 text-center">Current Bid: $<?php echo number_format($currentBidPrice, 2); ?></p>

    <!-- Timer container -->
    <?php if (!$hasBiddingEnded): ?>
        <div id="countdown-container" class="text-center">
            <span>Bidding Ends In: </span>
            <span id="countdown"></span>
        </div>
    <?php else: ?>
        <div id="countdown-container" class="text-center">
            <span id="countdown">Bidding Time is Over</span>
        </div>
    <?php endif; ?>
    
    <!-- Bid Section -->
    <div id="bid-section" class="flex flex-col items-center mt-4">
        <?php if (isset($error)): ?>
            <p class="text-red-500 text-center mb-4"><?php echo $error; ?></p>
        <?php endif; ?>

        <?php if (!$hasBiddingEnded): ?>
            <button id="placeBidButton" class="btn btn-primary w-full" onclick="showBidForm()">Place Bid</button>
            
            <!-- Bid Form: Initially Hidden -->
            <form id="bidForm" method="POST" action="" style="display: none;" class="w-full mt-2" onsubmit="return validateBid()">
                <input type="number" id="bidAmount" name="bid_amount" placeholder="Enter your bid" class="input input-bordered w-full mt-2" required>
                <button type="submit" class="btn btn-success w-full mt-2">Submit Bid</button>
            </form>
        <?php else: ?>
            <p class="text-green-500 text-center">The final bid price is: $<?php echo number_format($currentBidPrice, 2); ?></p>
        <?php endif; ?>
    </div>
</div>
</div>

    <!-- Fullscreen Image Container: Initially Hidden -->
    <div id="fullscreenContainer" class="fullscreen-img-container" style="display: none;" onclick="toggleFullscreenImage()">
        <img id="fullscreenImage" class="fullscreen-img">
    </div>


    <script>
        function toggleFullscreenImage() {
            const fullscreenContainer = document.getElementById('fullscreenContainer');
            const fullscreenImage = document.getElementById('fullscreenImage');
            const artImage = document.getElementById('artImage');
            const cardContainer = document.getElementById('cardContainer');

            if (fullscreenContainer.style.display === 'none') {
                fullscreenImage.src = artImage.src;
                fullscreenContainer.style.display = 'flex';
                cardContainer.style.display = 'none';
            } else {
                fullscreenContainer.style.display = 'none';
                cardContainer.style.display = 'block';
            }
        }

        function showBidForm() {
            document.getElementById('placeBidButton').style.display = 'none';

            document.getElementById('bidForm').style.display = 'block';
        }

        function validateBid() {
            const currentBidPrice = <?php echo $currentBidPrice; ?>;
            const bidAmount = parseFloat(document.getElementById('bidAmount').value);

            if (bidAmount <= currentBidPrice) {
                alert("Your bid must be higher than the current bid price of $" + currentBidPrice.toFixed(2));
                return false;
            }
            return true; 
        }
    </script>
</body>
<?php
include"../Header_Footer/footer.php";
?>

</html>
