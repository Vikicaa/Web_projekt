<?php

include ("db_config.php");

$user_name = $_POST['user_name'];
$user_password = $_POST['user_password'];
$user_email = $_POST['user_email'];
$user_phone = $_POST['user_phone'];
    
global $connection;

    // Ellenőrizd, hogy az e-mail cím már regisztrálva van-e
    $sql = "SELECT * FROM users WHERE user_email = '$user_email'";
    $result = $connection->query($sql);
    if (strlen($user_password) < 8) {
        echo "The password need to be minimum 8 character.";
    }
    if (!preg_match("/[A-Z]/", $user_password)) {
        echo "The password need to contain a capital letter.";
    }
    if ($result->num_rows > 0) {
    echo "This email is already registrated!";
    } else {
        $hashedPassword = password_hash($user_password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (user_name, user_password, user_email, user_phone) VALUES ('$user_name', '$hashedPassword', '$user_email',  '$user_phone')";
    if ($connection->query($sql) === TRUE) {
        echo "Registration is succesfully!";
    } else {
        echo "Something went wrong while registration: " . $connection->error;
    }
    }

    header('Location: login.php');
exit();
?>