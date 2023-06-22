<?php

session_start();

include ("db_config.php");

// Ellenőrizd az admin bejelentkezést
if (isset($_POST['home_page'])) {
    $admin_name = $_POST['admin_name'];
    $admin_password = $_POST['admin_password'];

    // Ellenőrizd az admin felhasználónevet és jelszót az adatbázisban
    $sql = "SELECT * FROM admin WHERE admin_name = '$admin_name'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['admin_password'];

        // Ellenőrizd a jelszó helyességét
        if (password_verify($admin_password, $hashedPassword)) {
            // Admin bejelentkezés sikeres
            $_SESSION['admin_loggedIn'] = true;
            $_SESSION['admin_name'] = $admin_name;

            // További műveletek az admin bejelentkezés után

            header("Location: events.php");
            exit;
        }
    }

    // Admin bejelentkezés sikertelen
    header("Location: home_page.php?error=invalid_credentials");
    exit;
}

?>


