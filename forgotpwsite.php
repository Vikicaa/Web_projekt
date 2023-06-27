<?php
// Adatbázis kapcsolat beállítása
include("db_config.php");

global $connection;

$errors = array();

// Űrlap beküldésének ellenőrzése és az új jelszó frissítése
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $newPassword = isset($_POST['new_password']) ? $_POST['new_password'] : '';
    $confirmPassword = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

    // Új jelszó ellenőrzése
    if ($newPassword !== $confirmPassword) {
        $errors['new_password'] = "The passwords do not match.";
        $_SESSION['errors'] = $errors;
    } elseif (strlen($newPassword) < 8 || !preg_match("/[A-Z]/", $newPassword)) {
        $errors['new_password'] = "The password needs to be a minimum of 8 characters and needs to contain a capital letter.";
        $_SESSION['errors'] = $errors;
    } else {
        // Felhasználói adatok lekérdezése az adatbázisból
        $query = "SELECT user_password FROM users WHERE user_email = '$email'";
        $result = $connection->query($query);

        if ($result->num_rows > 0) {
            $userData = $result->fetch_assoc();
            $storedPassword = $userData['user_password'];

            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            $updateQuery = "UPDATE users SET user_password = '$hashedPassword' WHERE user_email = '$email'";
            $connection->query($updateQuery);

            $errors['new_password'] = "The password is updated!";
            $_SESSION['errors'] = $errors;
        } else {
            // Hiba: Felhasználó nem található
            $errors['new_password'] = "User not found.";
            $_SESSION['errors'] = $errors;
        }
    }
    header('Location: login.php');
} else {   
    unset($_SESSION['errors']);
}
$connection->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Felhasználói profil</title>
    <link rel="icon" type="image/png" sizes="16x16" href="images/icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
    <link rel="stylesheet" type="text/css" href="CSS/login.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <style>
        form {
            height: 70%;
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

<?php session_start(); ?>

<!-- Jelszóváltás kérése űrlap -->
<form action="" method="POST">
    <h3>Password change</h3>

    <label for="email">Your email:</label>
    <input type="email" id="email" name="email" required><br>
    
    <label for="new_password">New Password:</label>
    <input type="password" id="new_password" name="new_password" required><br>

    <label for="confirm_password">New Password Confirmation:</label>
    <input type="password" id="confirm_password" name="confirm_password" required><br>
    <?php if(isset($_SESSION['errors']['new_password'])) { echo '<p class="error">'.$_SESSION['errors']['new_password'].'</p>'; } ?><br>

    <button type="submit">Change Password</button>
</form>

</body>
</html>
