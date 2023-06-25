<?php
session_start();

// Adatbázis kapcsolat beállítása
include("db_config.php");

$email = $_SESSION['forgorpwuser_email'];


    // Űrlap beküldésének ellenőrzése és az új jelszó frissítése
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $currentPassword = $_POST['current_password'];
        $newPassword = $_POST['new_password'];
        global $connection;

        // Felhasználói adatok lekérdezése az adatbázisból
        $query = "SELECT user_password FROM users WHERE user_email = '$email'";
        $result = $connection->query($query);

        if ($result->num_rows > 0) {
            $userData = $result->fetch_assoc();
            $storedPassword = $userData['user_password'];

            // Jelenlegi jelszó ellenőrzése
            if (password_verify($currentPassword, $storedPassword)) {


                // Új jelszó ellenőrzése
                if ($currentPassword !== $newPassword) {
                    if (strlen($user_password) < 8 || !preg_match("/[A-Z]/", $user_password)) {
                        $errors['user_password'] = "The password needs to be a minimum of 8 characters and needs to contain a capital letter.";
                        $_SESSION['errors'] = $errors;
                    } else {
                        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                        $updateQuery = "UPDATE users SET user_password = '$hashedPassword' WHERE user_email = '$email'";
                        $connection->query($updateQuery);

                        echo "The password is updated!";
                    }
                } else {
                    // Hiba: Az új jelszó megegyezik a jelenlegi jelszóval
                    echo "The new password can't be the same like the old one.";
                }
            }
            else {
                // Hiba: Helytelen jelenlegi jelszó
                echo "Incorrect Password.";
                echo $storedPassword;
            }
        } 
        else {
            // Hiba: Felhasználó nem található
            echo "User not found.";
        }
    }
$connection->close();
?>