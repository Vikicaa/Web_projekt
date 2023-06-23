<?php

include ("db_config.php");
// Az admin által megadott adatok
$admin_name = $_POST['admin_name'];
$admin_password = $_POST['admin_password'];

global $connection;

// Ellenőrizze az admin adatokat az adatbázisban
$sql = "SELECT * FROM admin WHERE admin_name = '$admin_name' AND admin_password = '$admin_password'";
$result = $connection->query($sql);

// Ellenőrizze, hogy van-e találat
if ($result->num_rows > 0) {
    // Az admin adatok helyesek, beléptetés
    session_start();
    $_SESSION['admin'] = true;

    // Átirányítás a főoldalra
    header('Location: home_page.php');
    exit();
} else {
    // Helytelen admin adatok
    echo "Helytelen felhasználónév vagy jelszó!";
}

header('Location: home_page.php');
exit();
?>



