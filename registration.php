<?php
session_start();

$errors = array();
ini_set('display_errors', 'On');
error_reporting(E_ALL);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("db_config1.php");

    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];
    $user_email = $_POST['user_email'];
    $user_phone = $_POST['user_phone'];

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Ellenőrizd, hogy az e-mail cím már regisztrálva van-e
        $stmt = $pdo->prepare("SELECT * FROM users WHERE user_email = :user_email");
        $stmt->bindParam(":user_email", $user_email);
        $stmt->execute();

        if (strlen($user_password) < 8 || !preg_match("/[A-Z]/", $user_password)) {
            $errors['user_password'] = "The password needs to be a minimum of 8 characters and needs to contain a capital letter.";
            $_SESSION['errors'] = $errors;
        }
        if ($stmt->rowCount() > 0) {
            $errors['user_email'] = "This email is already registered!";
            $_SESSION['errors'] = $errors;
        }

        if (count($errors) === 0) {
            $hashedPassword = password_hash($user_password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (user_name, user_password, user_email, user_phone) VALUES (:user_name, :user_password, :user_email, :user_phone)");
            $stmt->bindParam(":user_name", $user_name);
            $stmt->bindParam(":user_password", $hashedPassword);
            $stmt->bindParam(":user_email", $user_email);
            $stmt->bindParam(":user_phone", $user_phone);
            $stmt->execute();

            header('Location: login.php');
            exit();
        }
    } catch (PDOException $e) {
        echo "Something went wrong while registration: " . $e->getMessage();
    }
} else {
    unset($_SESSION['errors']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Event Organization</title>
    <link rel="icon" type="image/png" sizes="16x16" href="images/icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
    <link rel="stylesheet" type="text/css" href="CSS/login.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <script src="JS/script.js"></script>
    <style>
        form {
            height: 910px;
        }

        .error {
            font-family: 'Poppins', sans-serif;
            color: red;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
<header>
</header>
<div class="background">
    <div class="shape"></div>
    <div class="shape"></div>
</div>
<form action="" method="POST">
    <h3>Create an account</h3>
    <label for="user_name">Username:</label>
    <input type="text" placeholder="Username:" id="username" name="user_name" required><br>

    <label for="user_password">Password:</label>
    <input type="password" placeholder="Password:" id="password" name="user_password" required><br>
    <?php if (isset($_SESSION['errors']['user_password'])) {
        echo '<p class="error">' . $_SESSION['errors']['user_password'] . '</p>';
    } ?><br>

    <label for="user_email">Email:</label>
    <input type="email" placeholder="Email:" id="password" name="user_email" required><br>
    <?php if (isset($_SESSION['errors']['user_email'])) {
        echo '<p class="error">' . $_SESSION['errors']['user_email'] . '</p>';
    } ?><br>

    <label for="user_phone">Phone:</label>
    <input type="text" placeholder="Phone number:" id="password" name="user_phone" required><br><br>

    <button type="submit" onclick="register()">Create</button>
    <button type="button" onclick="openLoginSite()">Log in</button>

</form>

</body>
</html>
