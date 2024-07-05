<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZenithZone</title>
</head>
<body>
    <h2>Register</h2>
    <form action="ch.php" method="POST">
        <label for="reg_username">Username:</label>
        <input type="text" id="reg_username" name="reg_username" required>
        <br>
        <label for="reg_password">Password:</label>
        <input type="password" id="reg_password" name="reg_password" required>
        <br>
        <button type="submit" name="register">Register</button>
    </form>

    <h2>Login</h2>
    <form action="ch.php" method="POST">
        <label for="login_username">Username:</label>
        <input type="text" id="login_username" name="login_username" required>
        <br>
        <label for="login_password">Password:</label>
        <input type="password" id="login_password" name="login_password" required>
        <br>
        <button type="submit" name="login">Login</button>
    </form>

    <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ZenithZone";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['register'])) {
        $reg_username = $_POST['reg_username'];
        $reg_password = password_hash($_POST['reg_password'], PASSWORD_BCRYPT);

        $sql = "INSERT INTO `Check` (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $reg_username, $reg_password);

        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    if (isset($_POST['login'])) {
        $login_username = $_POST['login_username'];
        $login_password = $_POST['login_password'];

        $sql = "SELECT password FROM `Check` WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $login_username);
        $stmt->execute();
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($login_password, $hashed_password)) {
            echo "Welcome, " . htmlspecialchars($login_username) . "!";
        } else {
            echo "Invalid username or password.";
        }

        $stmt->close();
    }

    $conn->close();
    ?>
</body>
</html>
