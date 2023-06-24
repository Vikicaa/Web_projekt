<?php

session_start();

include ("db_config.php");

// Check if the user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // User is already logged in, redirect to the home page or any other logged-in page
    header('Location: user_home.php');
    exit();
}

// Felhasználó által megadott adatok
if (isset($_POST['user_name']) && isset($_POST['user_password'])) {
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
    
            $_SESSION['loggedin'] = true;

             // Átirányítás a főoldalra
            header('Location: user_home.php');
            exit();
        } else {
            // Helytelen felhasználói adatok
            echo "Incorrect password !";
        }
    }else {
        // Helytelen felhasználói adatok
        echo "Incorrect username !";
    }
}
?>
