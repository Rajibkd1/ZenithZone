window.onload = function () {
  render();
};

function render() {
  window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier(
    "recaptcha-container"
  );
  recaptchaVerifier.render();
}
// Ensure this code runs after the Firebase scripts have loaded
window.onload = function () {
  renderRecaptcha(); // Call this function on page load to ensure the reCAPTCHA is ready
};

function renderRecaptcha() {
  window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier(
    "recaptcha-container",
    {
      size: "invisible", // or 'normal' if you want it visible
      callback: (response) => {
        // reCAPTCHA solved, allow signInWithPhoneNumber
        console.log("reCAPTCHA solved");
      },
      "expired-callback": () => {
        // Handle expired reCAPTCHA here
        console.log("reCAPTCHA expired");
      },
    }
  );
  window.recaptchaVerifier.render().then(function (widgetId) {
    window.recaptchaWidgetId = widgetId;
  });
}

function phoneAuth() {
  var number = "+88" + document.getElementById("number").value.replace(/\D/g, "");
  firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier)
      .then(function (confirmationResult) {
          window.confirmationResult = confirmationResult;
          console.log("SMS sent successfully");
          // Optionally, update UI to reflect successful SMS send
      })
      .catch(function (error) {
          console.error("Error during phone auth: ", error);
          displayError(error.message); // Display the error using a custom function
      });
}


function displayError(message) {
    var errorDisplay = document.getElementById("errorDisplay");
    if (errorDisplay) {
        errorDisplay.textContent = message; // Set the error message
        errorDisplay.classList.remove("hidden"); // Make sure it's visible
    }
}


function showModal(title, message, type) {
    const modalIcon = document.getElementById("modalIcon");
    const modalTitle = document.getElementById("modalTitle");
    const modalMessage = document.getElementById("modalMessage");
    const messageModal = document.getElementById("messageModal");

    if (type === "success") {
        modalIcon.className = "fa-solid fa-circle-check fa-5x";
        modalIcon.style.color = "#3feeba";
    } else {
        modalIcon.className = "fa-solid fa-circle-exclamation fa-5x";
        modalIcon.style.color = "#ff6b6b";
    }

    modalTitle.textContent = title;
    modalMessage.textContent = message;
    modalMessage.className = type === "success" ? "mt-2 text-green-700" : "mt-2 text-red-500";

    messageModal.classList.remove("hidden");

    // Automatically close the modal after 3 seconds
    setTimeout(function() {
        messageModal.classList.add("hidden");
    }, 3000);
}

function codeverify() {
    var code = document.getElementById("verificationCode").value;
    confirmationResult.confirm(code)
        .then(function (result) {
            console.log("Verification successful", result);
            document.getElementById("otpVerified").value = "true"; // Update hidden field
            document.getElementById("submitBtn").disabled = false; // Enable the submit button
            showModal("OTP Verification Successful!", "You have successfully verified your OTP.", "success");
        })
        .catch(function (error) {
            console.error("Error during verification", error);
            showModal("Verification Failed", error.message, "error");
            document.getElementById("submitBtn").disabled = true; // Keep the submit button disabled
        });
}

