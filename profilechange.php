<?php
session_start();

include("db_config.php");
$user_id = $_SESSION['user_id'];
// Űrlap beküldésének ellenőrzése és az adatok frissítése
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newName = $_POST['user_name'];
    $newPassword = $_POST['user_password'];
    $newEmail = $_POST['user_email'];
    $newPhone = $_POST['user_phone'];

    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Ellenőrizd, hogy van bejelentkezett felhasználó és lekérdezd az email címet
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['user_email'])) {
        $loggedInEmail = $_SESSION['user_email'];

        // Ellenőrizd, hogy az aktuális felhasználó létezik az adatbázisban
        $query = "SELECT * FROM users WHERE user_id = '$user_id'";
        $result = $connection->query($query);

        if ($result->num_rows > 0) {
            // Aktuális felhasználó megtalálva az adatbázisban
            $query = "UPDATE users SET user_name = '$newName', user_password = '$hashedPassword', user_email = '$newEmail', user_phone = '$newPhone' WHERE user_id = '$user_id'";
            $connection->query($query);
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['user_password'] = $user_password;
            echo "The profile is updated!";
            header('Location: logout.php');
        } else {
            echo "User not found.";
        }
    } else {
        echo "User not found.";
    }
} else {
    echo "Something went wrong with change requests.";
}

$connection->close();
?>