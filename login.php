<?php
session_start();
ini_set('display_errors', 'On');
error_reporting(E_ALL);
$errors = array();
unset($_SESSION['errors']);
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: user_home.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include("db_config1.php");

    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    // Adatbázis kapcsolat létrehozása
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE user_email = :user_email");
    $stmt->bindParam(':user_email', $user_email);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $storedPassword = $row['user_password'];
        $activated = $row['activated'];

        

        if ($activated == 1) {
            if (password_verify($user_password, $storedPassword)) {
                // Bejelentkezés sikeres
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_name'] = $user_name;
                $_SESSION['user_email'] = $user_email;
                $_SESSION['user_password'] = $user_password;
    
                header('Location: user_home.php');
                exit();
            } else {
                $errors['user_password'] = "Incorrect email or password!";
            }
        } else {
            $errors['general'] = "Your account is not activated yet. Please check your email for the activation link.";
        }
    } else {
        $errors['user_email'] = "Incorrect email or password!";
    }

    $_SESSION['errors'] = $errors;

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
    <script src="JS\script.js"></script>
    <style>

        form {
            height: 850px;
            width:450px
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

<div class="background">
    <div class="shape"></div>
    <div class="shape"></div>
</div>

<form action="" method="POST">

    <h3>Login Here</h3>

    <label for="user_email">User Email:</label>
    <input type="email" placeholder="Email:" name="user_email" id="user_email" required><br>

    <label for="user_password">Password:</label>
    <input type="password" placeholder="Password:" id="password" name="user_password" required><br><br>

    <a href="forgotpw.php">Forgot password?</a>

    <?php if (isset($_SESSION['errors']['user_password'])) {
        echo '<p class="error">' . $_SESSION['errors']['user_password'] . '</p>';
    } ?><br>
    <?php if (isset($_SESSION['errors']['user_email'])) {
        echo '<p class="error">' . $_SESSION['errors']['user_email'] . '</p>';
    } ?><br>
    <?php if (isset($_SESSION['errors']['general'])) {
        echo '<p class="error">' . $_SESSION['errors']['general'] . '</p>';
    } ?><br>

    <button type="submit" onclick="login()">Log in</button>
    <button type="button" onclick="openRegSite()">Sign up</button>
    <button type="button" onclick="parent.location='adminlogin.php'">Admin</button>

</form>
</body>
</html>
