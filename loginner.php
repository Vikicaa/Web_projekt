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
if (isset($_POST['user_email']) && isset($_POST['user_password'])) {
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    global $connection;

    // Ellenőrizze a felhasználói adatokat az adatbázisban
    $sql = "SELECT * FROM users WHERE user_email = '$user_email'";
    $result = $connection->query($sql);

    // Ellenőrizze, hogy van-e találat
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_name = $row['user_name'];
        $storedPassword = $row['user_password'];
        

        if (password_verify($user_password, $storedPassword)) {
    
            $_SESSION['loggedin'] = true;

            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['user_password'] = $user_password;
        
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
