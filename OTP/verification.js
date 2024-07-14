import { auth } from "./firebase-config.js";
import { RecaptchaVerifier, signInWithPhoneNumber, signInWithCredential } from "https://www.gstatic.com/firebasejs/10.12.3/firebase-auth.js";

window.onload = function () {
    render();
};

function render() {
    window.recaptchaVerifier = new RecaptchaVerifier('recaptcha-container', {}, auth);
    recaptchaVerifier.render();
}

function phoneAuth() {
    const number = document.getElementById('number').value;
    const appVerifier = window.recaptchaVerifier;
    signInWithPhoneNumber(auth, number, appVerifier)
        .then((confirmationResult) => {
            window.confirmationResult = confirmationResult;
            console.log("OTP has been sent");
            alert("OTP sent. Check your phone.");
        }).catch((error) => {
            console.error("SMS not sent", error);
        });
}

function codeVerify() {
    const code = document.getElementById('verification').value;
    confirmationResult.confirm(code)
        .then((result) => {
            const user = result.user;
            console.log("Successfully verified", user);
            alert("Phone number successfully verified!");
        }).catch((error) => {
            console.error("Verification failed", error);
            alert("Incorrect verification code.");
        });
}
