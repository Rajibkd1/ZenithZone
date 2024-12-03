<?php
session_start();
include('../Database_Connection/DB_Connection.php'); // Include your DB connection file

// Function to send OTP to the mobile number (Simulated for this example)
function checkOTPVerification() {
    // Check if the OTP has been verified
    if (!isOtpVerified) {
        alert('Please verify your OTP before submitting the form.');
        return false; // Prevent form submission
    }
    return true; // Allow form submission
}

function sendOTP() {
    const number = document.getElementById("number").value;
    if (number.length === 11) {
        fetch("./OTP.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: new URLSearchParams({
                    send_otp: true,
                    phone_number: number,
                }),
            })
            .then((response) => response.json())
            .then((data) => {
                const messageDiv = document.getElementById("otpMessage");
                messageDiv.classList.remove("hidden");
                messageDiv.textContent = data.message;
            })
            .catch((error) => {
                console.error("Error:", error);
                alert("Failed to send OTP. Please try again.");
            });
    } else {
        alert("Please enter a valid mobile number.");
    }
}

function verifyOTP() {
    const enteredOTP = document.getElementById("verificationCode").value;
    fetch("./OTP.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: new URLSearchParams({
                verify_otp: true,
                otp: enteredOTP,
            }),
        })
        .then((response) => response.json())
        .then((data) => {
            alert(data.message);
            if (data.status === "success") {
                isOtpVerified = true; // Set OTP verification flag to true
                document.getElementById("otpVerified").value = "true";
                showSuccessModal("OTP Verified", "Your OTP has been verified successfully.");
            } else {
                isOtpVerified = false; 
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("Failed to verify OTP. Please try again.");
            isOtpVerified = false;
        });
}

function showSuccessModal(title, message) {
    const modal = document.getElementById("successModal");
    modal.querySelector("h3").textContent = title;
    modal.querySelector("p").textContent = message;
    modal.classList.remove("hidden");
}

document.addEventListener('DOMContentLoaded', function() {
    if (typeof registrationSuccess !== 'undefined' && registrationSuccess) {
        showSuccessModal("Registration Successful!", "You have successfully registered.");
    } else if (typeof errorMessage !== 'undefined' && errorMessage) {
        alert(errorMessage);
    }
});

// Step 1: Mobile Number Form
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mobileNumber'])) {
    $mobileNumber = $_POST['mobileNumber'];

    // Check if the mobile number exists in the database
    $query = "SELECT * FROM users WHERE mobile_number = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $mobileNumber);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Send OTP
        sendOTP($mobileNumber);
        echo '<form method="POST" action="resetPassword.php">
                <input type="text" name="otp" placeholder="Enter OTP" required>
                <input type="submit" value="Verify OTP">
              </form>';
    } else {
        echo "Mobile number not found in the database.";
    }
}

// Step 2: OTP Verification
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['otp'])) {
    $otp = $_POST['otp'];

    // Verify OTP
    if ($otp == $_SESSION['otp']) {
        echo '<form method="POST" action="resetPassword.php">
                <input type="password" name="newPassword" placeholder="New Password" required>
                <input type="password" name="confirmPassword" placeholder="Confirm Password" required>
                <input type="submit" value="Submit New Password">
              </form>';
    } else {
        echo "Invalid OTP.";
    }
}

// Step 3: New Password Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['newPassword'])) {
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Check if passwords match
    if ($newPassword === $confirmPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT); // Secure password hashing

        // Update password in the database
        $query = "UPDATE users SET password = ? WHERE mobile_number = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $hashedPassword, $_SESSION['mobileNumber']);
        $stmt->execute();

        echo "Your password has been successfully updated!";
        session_destroy(); // Destroy session to prevent resubmission
    } else {
        echo "Passwords do not match.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>
<body>
    <h2>Reset Your Password</h2>
    <form method="POST" action="resetPassword.php">
        <input type="text" name="mobileNumber" placeholder="Enter your Mobile Number" required>
        <input type="submit" value="Next">
    </form>
</body>
</html>
