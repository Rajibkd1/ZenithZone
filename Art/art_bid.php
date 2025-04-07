<?php
session_start();
include "../Database_Connection/DB_Connection.php";

// Ensure proper session and user type
$isLoggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'];
$isCustomer = isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'customer_info';

// Get the art ID from the URL query parameter
$artId = isset($_GET['artId']) ? intval($_GET['artId']) : 0;

// Fetch art details (including bid_status) using the art ID
$query = "SELECT art_name, art_description, art_img, final_bid_price, previous_bid_price, art_init_price, bid_end_date, bid_status 
          FROM art_gallery 
          WHERE art_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $artId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("Art not found.");
}

// Determine the current bid price (if no bid yet, use the initial price)
if ($row['previous_bid_price'] === null || $row['previous_bid_price'] == 0) {
    $currentBidPrice = $row['art_init_price'];
} else {
    $currentBidPrice = $row['previous_bid_price'];
}

$bidEndDate = $row['bid_end_date'];
$hasBiddingEnded = (new DateTime() > new DateTime($bidEndDate));

$winner = null;
$finalBidPrice = $row['final_bid_price']; // use stored final bid price if any

// If bidding has ended, fetch the highest bidder and update the art_gallery record
if ($hasBiddingEnded) {
    $winnerQuery = "SELECT c.customer_id, c.first_name, c.last_name, ab.bid_amount
                    FROM art_bids ab
                    JOIN customer_info c ON ab.customer_id = c.customer_id
                    WHERE ab.art_id = ?
                    ORDER BY ab.bid_amount DESC
                    LIMIT 1";
    $stmtWinner = $conn->prepare($winnerQuery);
    $stmtWinner->bind_param("i", $artId);
    $stmtWinner->execute();
    $winnerResult = $stmtWinner->get_result();

    if ($winnerResult->num_rows > 0) {
        $winner = $winnerResult->fetch_assoc();
        $winnerCustomerId = $winner['customer_id'];
        $finalBidPrice = $winner['bid_amount'];

        // Update art_gallery only if not already closed
        if ($row['bid_status'] !== 'closed') {
            $updateQuery = "UPDATE art_gallery
                            SET winner_customer_id = ?, final_bid_price = ?, bid_status = 'closed'
                            WHERE art_id = ?";
            $stmtUpdate = $conn->prepare($updateQuery);
            // Bind: integer, double, integer
            $stmtUpdate->bind_param("idi", $winnerCustomerId, $finalBidPrice, $artId);
            if (!$stmtUpdate->execute()) {
                error_log("Error updating art_gallery: " . $stmtUpdate->error);
            }
        }
    } else {
        // No bids were placed; final bid remains as initial price and winner remains null
        $finalBidPrice = $row['art_init_price'];
        $winner = null;
    }
}

// Handle bid submission only if the request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['bid_amount'])) {
    $newBid = (float) $_POST['bid_amount'];

    // Ensure the bid is higher than the current bid and bidding is still active
    if ($newBid > $currentBidPrice && !$hasBiddingEnded) {
        // Update the current bid in the art_gallery table
        $updateQuery = "UPDATE art_gallery SET previous_bid_price = ? WHERE art_id = ?";
        $stmtUpdateBid = $conn->prepare($updateQuery);
        $stmtUpdateBid->bind_param("di", $newBid, $artId);
        if ($stmtUpdateBid->execute()) {
            // Insert the new bid record into the art_bids table
            $customerId = $_SESSION['user_id']; // Ensure this session variable is set correctly
            $insertBidQuery = "INSERT INTO art_bids (art_id, customer_id, bid_amount) VALUES (?, ?, ?)";
            $stmtInsertBid = $conn->prepare($insertBidQuery);
            $stmtInsertBid->bind_param("iid", $artId, $customerId, $newBid);
            if ($stmtInsertBid->execute()) {
                // Redirect to refresh the page with updated bid information
                header("Location: ./art_show_page.php?artId=" . $artId);
                exit;
            } else {
                $error = "Error inserting bid: " . $conn->error;
            }
        } else {
            $error = "Error updating bid: " . $conn->error;
        }
    } else {
        $error = "Your bid must be higher than the current bid price or bidding has ended.";
    }
}

// Fetch the list of bidders for this art piece
$queryBidders = "SELECT ab.bid_amount, c.first_name, c.last_name 
                 FROM art_bids ab
                 JOIN customer_info c ON ab.customer_id = c.customer_id
                 WHERE ab.art_id = ?
                 ORDER BY ab.bid_time DESC";
$stmtBidders = $conn->prepare($queryBidders);
$stmtBidders->bind_param("i", $artId);
$stmtBidders->execute();
$biddersResult = $stmtBidders->get_result();

// Close the database connection
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
  <link rel="stylesheet" href="./Art.css">
  <link rel="icon" href="../assets/images/logo/ZenithZone.png" type="image/x-icon">
  <script>
    // Countdown timer function
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
          countdownElement.innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
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
<body class="bg-gray-100 flex flex-col min-h-screen">
  <div class="flex flex-col justify-center sm:flex-row mt-48 mb-12">
    <!-- Art Card -->
    <div id="cardContainer" class="card bg-white shadow-lg rounded-lg p-6 max-w-4xl">
      <div class="flex justify-center">
        <img src="<?php echo htmlspecialchars($row['art_img']); ?>" alt="Artwork" class="rounded-lg w-56 h-64 cursor-pointer" id="artImage" onclick="toggleFullscreenImage()">
      </div>
      <h2 class="text-3xl font-bold my-4 text-center"><?php echo htmlspecialchars($row['art_name']); ?></h2>
      <p class="text-gray-600 text-center"><?php echo htmlspecialchars($row['art_description']); ?></p>
      <p class="text-lg font-semibold mt-3 text-center">Current Bid: $<?php echo number_format($currentBidPrice, 2); ?></p>
      <!-- Timer -->
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
          <!-- Bid Form (initially hidden) -->
          <form id="bidForm" method="POST" action="" style="display: none;" class="w-full mt-2" onsubmit="return validateBid()">
            <input type="number" id="bidAmount" name="bid_amount" placeholder="Enter your bid" class="input input-bordered w-full mt-2" required>
            <button type="submit" class="btn btn-success w-full mt-2">Submit Bid</button>
          </form>
        <?php else: ?>
          <!-- Bidding ended: show final bid price and winner details -->
          <p class="text-green-500 text-center">The final bid price is: $<?php echo number_format($finalBidPrice, 2); ?></p>
          <p class="text-center mt-4 p-2 font-bold text-2xl text-green-500">
            <span class="text-glow">
              <?php
                if (isset($winner) && !empty($winner)) {
                  echo "Winner: " . htmlspecialchars($winner['first_name'] . ' ' . $winner['last_name']);
                } else {
                  echo "Winner: ";
                }
              ?>
            </span>
          </p>
        <?php endif; ?>
        <style>
          .text-glow {
            @apply text-yellow-500;
            text-shadow: 0 0 10px rgba(255, 255, 0, 0.8), 0 0 20px rgba(255, 255, 0, 0.8), 0 0 30px rgba(255, 255, 0, 0.8);
          }
        </style>
      </div>
    </div>
    <!-- Bidder List -->
    <div class="ml-16 mt-16">
      <h2 class="text-xl font-semibold text-center mb-4">Bidders List</h2>
      <button id="toggleButton" class="px-4 py-2 bg-blue-500 text-white rounded-lg mb-4 hover:bg-blue-700">
        Show Bidder List
      </button>
      <div id="biddersList" class="hidden w-46">
        <div class="flex justify-between font-semibold text-gray-700 mb-4">
          <span class="w-20 text-center">Serial No</span>
          <span class="w-24 text-center">Name</span>
          <span class="w-20 text-center">Bid Amount</span>
        </div>
        <?php if ($biddersResult->num_rows > 0): ?>
          <div class="overflow-y-auto max-h-96">
            <ul class="space-y-4">
              <?php
                $serialNo = 1;
                while ($bidder = $biddersResult->fetch_assoc()) {
                  echo "<li class='flex justify-between items-center p-4 bg-white shadow rounded-lg hover:bg-gray-100'>
                          <span class='w-20 text-center'>{$serialNo}</span>
                          <span class='w-24 text-center'>" . htmlspecialchars($bidder['first_name'] . ' ' . $bidder['last_name']) . "</span>
                          <span class='w-20 text-center font-semibold text-blue-600'>\$" . number_format($bidder['bid_amount'], 2) . "</span>
                        </li>";
                  $serialNo++;
                }
              ?>
            </ul>
          </div>
        <?php else: ?>
          <p class="text-center text-gray-500">No bids placed yet.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <!-- Fullscreen Image Container -->
  <div id="fullscreenContainer" class="fullscreen-img-container" style="display: none;" onclick="toggleFullscreenImage()">
    <img id="fullscreenImage" class="fullscreen-img">
  </div>
  <!-- Modal Structure -->
  <div id="messageModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-5 shadow text-center">
      <i id="modalIcon" class="fas fa-exclamation-circle fa-5x text-red-500"></i>
      <h3 id="modalTitle" class="text-lg font-bold mt-4">Title Here</h3>
      <p id="modalMessage" class="mt-2">Message Here</p>
      <button onclick="hideModal()" class="mt-4 bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600">Close</button>
    </div>
  </div>
  <script>
      function showBidForm() {
    var isLoggedIn = <?php echo json_encode($isLoggedIn && $isCustomer); ?>;
    if (isLoggedIn) {
      document.getElementById('placeBidButton').style.display = 'none';
      document.getElementById('bidForm').style.display = 'block';
    } else {
      showModal('Please Log In', 'You must be logged in as a customer to proceed with the purchase.');
    }
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
</html>
