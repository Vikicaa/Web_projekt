<?php
session_start();

include("db_config.php");

// Fiók törlése gomb lenyomásának ellenőrzése
if (isset($_POST['delete_account'])) {
    // Ellenőrizd, hogy van bejelentkezett felhasználó és lekérdezd az email címet
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['user_email'])) {
        $loggedInEmail = $_SESSION['user_email'];

        // Ellenőrizd, hogy az aktuális felhasználó létezik az adatbázisban
        $query = "SELECT * FROM users WHERE user_email = '$loggedInEmail'";
        $result = $connection->query($query);

        if ($result->num_rows > 0) {
            // Aktuális felhasználó megtalálva az adatbázisban, töröld a fiókját
            $deleteQuery = "DELETE FROM users WHERE user_email = '$loggedInEmail'";
            $connection->query($deleteQuery);

            echo "A profil sikeresen törölve lett!";
            header('Location: logout.php');
            header('Location: login.php');

        } else {
            echo "Felhasználó nem található.";
        }
    } else {
        echo "Felhasználó nem található.";
    }
} else {
    echo "Hiba a kérés feldolgozásában.";
}

$connection->close();

?>