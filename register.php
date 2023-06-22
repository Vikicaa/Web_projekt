<?php

include ("db_config.php");

function registerUser($name, $password, $email, $phone) {
    global $conn;

    // Ellenőrizd, hogy az e-mail cím már regisztrálva van-e
    $sql = "SELECT * FROM users WHERE user_email = '$email'";
    $result = $conn->query($sql);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "This ($email) email address is considered valid.";
    }
    else{
        echo "This ($email) email address is not valid.";
    }
    if ($result->num_rows > 0) {
        return "This e-mail is already registrated!";
    }
    if (strlen($password) < 8) {
        return "The password need to be minimum 8 character.";
    }
    if (!preg_match("/[A-Z]/", $password)) {
        return "The password need to contain a capital letter.";
    }
    

    // Hozd létre az új felhasználó rekordot az adatbázisban
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (user_name, user_password, user_email, user_phone) VALUES ('$name', '$hashedPassword', '$email',  '$phone')";
    if ($conn->query($sql) === TRUE) {
        return "Registration is succesfully!";
    } else {
        return "Something went wrong while registration: " . $conn->error;
    }
}
?>