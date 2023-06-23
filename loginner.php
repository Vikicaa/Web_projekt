<?php

include ("db_config.php");
// Felhasználó által megadott adatok
$user_name = $_POST['user_name'];
$user_password = $_POST['user_password'];
global $connection;

// Ellenőrizze a felhasználói adatokat az adatbázisban
$sql = "SELECT * FROM users WHERE user_name = '$user_name'";
$result = $connection->query($sql);

// Ellenőrizze, hogy van-e találat
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $storedPassword = $row['user_password'];

    if (password_verify($user_password, $storedPassword)) {
    
    session_start();
    $_SESSION['loggedin'] = true;

    // Átirányítás a főoldalra
    header('Location: home_page.php');
    exit();
} else {
    // Helytelen felhasználói adatok
    echo "Helytelen jelszó!";
}
}else {
    // Helytelen felhasználói adatok
    echo "Helytelen felhasználónév!";
}
?>
