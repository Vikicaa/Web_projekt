<?php

include ("db_config.php");

// Űrlap beküldésének ellenőrzése és az adatok frissítése
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newName = $_POST['user_name'];
    $newPassword = $_POST['user_password'];
    $newEmail = $_POST['user_email'];
    $newPhone = $_POST['user_phone'];

    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $query = "UPDATE users SET user_name = '$newName', user_password = '$hashedPassword', user_email = '$newEmail', user_phone = '$newPhone' WHERE user_id = '$loggedInEmail'";
    $connection->query($query);

    echo "Profile change is succesfull!"

} else {
    echo "User not found.";
}

$connection->close();
?>