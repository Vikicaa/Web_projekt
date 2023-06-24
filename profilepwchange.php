<?php
session_start();

// Adatbázis kapcsolat beállítása
include("db_config.php");

// Ellenőrizze a bejelentkezést és keresse meg az aktuális felhasználó email címét
// Ezt a részt az adott bejelentkezési rendszerhez igazítsa
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['user_email'])) {
    $loggedInEmail = $_SESSION['user_email'];

    // Űrlap beküldésének ellenőrzése és az új jelszó frissítése
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $currentPassword = $_POST['current_password'];
        $newPassword = $_POST['new_password'];
        global $connection;

        // Felhasználói adatok lekérdezése az adatbázisból
        $query = "SELECT user_password FROM users WHERE user_email = '$loggedInEmail'";
        $result = $connection->query($query);

        if ($result->num_rows > 0) {
            $userData = $result->fetch_assoc();
            $storedPassword = $userData['user_password'];

            // Jelenlegi jelszó ellenőrzése
            if (password_verify($currentPassword, $storedPassword)) {


                // Új jelszó ellenőrzése
                if ($currentPassword !== $newPassword) {
                    if (strlen($newPassword) < 8) {
                        echo "A jelszónak legalább 8 karakter hosszúnak kell lennie.";
                    }
                    if (!preg_match("/[A-Z]/", $newPassword)) {
                        echo "A jelszónak tartalmaznia kell legalább egy nagybetűt.";
                    } else {
                        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                        $updateQuery = "UPDATE users SET user_password = '$hashedPassword' WHERE user_email = '$loggedInEmail'";
                        $connection->query($updateQuery);

                        echo "A jelszóváltoztatás sikeres!";
                    }
                } else {
                    // Hiba: Az új jelszó megegyezik a jelenlegi jelszóval
                    echo "Az új jelszó nem lehet ugyanaz, mint a jelenlegi jelszó.";
                }
            }
            else {
                // Hiba: Helytelen jelenlegi jelszó
                echo "Helytelen jelenlegi jelszó.";
                echo $storedPassword;
            }
        } 
        else {
            // Hiba: Felhasználó nem található
            echo "Felhasználó nem található.";
        }
    }
}
$connection->close();
?>