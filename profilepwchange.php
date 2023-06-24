<?php

// Adatbázis kapcsolat beállítása
include ("db_config.php");


// Űrlap beküldésének ellenőrzése és az új jelszó frissítése
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];

    // Felhasználói adatok lekérdezése az adatbázisból
    $query = "SELECT user_password FROM users WHERE user_id = '$loggedInEmail'";
    $result = $connection->query($query);

    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();
        $currentHashedPassword = $userData['user_password'];

        // Jelenlegi jelszó ellenőrzése
        if (password_verify($currentPassword, $currentHashedPassword)) {
            // Új jelszó ellenőrzése
            if ($currentPassword !== $newPassword) {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                $updateQuery = "UPDATE users SET user_password = '$hashedPassword' WHERE user_id = '$loggedInEmail'";
                $connection->query($updateQuery);

                if (strlen($newPassword) < 8) {
                    echo "The password need to be minimum 8 character.";
                }
                if (!preg_match("/[A-Z]/", $newPassword)) {
                    echo "The password need to contain a capital letter.";
                }
                if($currentPassword === $newPassword){

                }else{
                    echo "Password change is succesfull!"
                }
            }
        }else {
            // Hiba: Az új jelszó megegyezik a jelenlegi jelszóval
            http_response_code(400); // Hibaüzenet: Bad Request
            echo "The password can't be same.";
        }
    } else {
        // Hiba: Helytelen jelenlegi jelszó
        http_response_code(401); // Hibaüzenet: Unauthorized
        echo "Incorrect password.";
    }
} else {
    // Hiba: Felhasználó nem található
    http_response_code(404); // Hibaüzenet: Not Found
    echo "User not found.";
}

$connection->close();
?>