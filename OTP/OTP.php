<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone OTP Verification</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <form action="#" method="POST" id="verificationForm">
        <h1>Phone Verification</h1>
        <div class="formcontainer">
            <hr/>
            <div class="container">
                <label for="number"><strong>Phone Number</strong></label>
                <input type="text" id="number" placeholder="Enter Phone Number" name="phone" required>
                <button type="button" onclick="phoneAuth()">Send OTP</button>
            </div>
        </div>
        <div class="formcontainer">
            <div class="container">
                <input type="text" id="verification" placeholder="Enter Verification Code" required>
                <button type="button" onclick="codeVerify()">Verify Code</button>
            </div>
        </div>
    </form>
    <script src="https://www.gstatic.com/firebasejs/10.12.3/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.12.3/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.12.3/firebase-analytics.js"></script>
    <script src="firebase-config.js"></script>
    <script src="verification.js"></script>
</body>
</html>
