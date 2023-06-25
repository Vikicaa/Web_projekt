<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Felhasználói profil</title>
	<link rel="icon" type="image/png" sizes="16x16" href="images/icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
  <link rel="stylesheet" type="text/css" href="CSS/profil.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">

</head>
<body>

<div class="background">
        <div class="shape"></div>
		<div class="shape"></div>
        <div class="shape"></div>
    </div>
    
<?php

// Adatbázis kapcsolat beállítása
include ("db_config.php");


// Ellenőrizze a bejelentkezést és keresse meg az aktuális felhasználó email címét
// Ezt a részt az adott bejelentkezési rendszerhez igazítsa
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['user_email'])) {
    $loggedInEmail = $_SESSION['user_email'];

    

    // Felhasználói adatok lekérdezése az adatbázisból az email cím alapján
    $query = "SELECT * FROM users WHERE user_email = '$loggedInEmail'";
    $result = $connection->query($query);

    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();
        $username = $userData['user_name'];
        $email = $userData['user_email'];
        $phone=$userData['user_phone'];
        

        // Űrlap mezők kitöltése az adatbázisban tárolt adatokkal
        echo '<!DOCTYPE html>
        <html>
        <head>
            <title>User Profile</title>
        </head>
        <body>
        
            <h1>User Profiel</h1>

            <section class="container">
            <h2>Profil adatok</h2>
            
            <p><br>Username: ' . $username . '</p>
            <p>Email: ' . $email . '</p>
            <p>Phone: ' . $phone . '</p>
        </section>
        </body>
        </html>';
    } else {
        echo '<p>User datas not found.</p>';
    }

    $connection->close();
} else {
    echo '<p>There is no loginned user.</p>';
}
?>

    <form method="POST" action="profilechange.php" class="container">
    <h2>Profile data change</h2>
        <label for="user_name">Username:</label>
        <input type="text" id="user_name" name="user_name" required><br>

        <label for="user_password">Password:</label>
        <input type="password" id="user_password" name="user_password" required><br>

        <label for="user_email">E-mail:</label>
        <input type="email" id="user_email" name="user_email" required><br>

        <label for="user_phone">Phone:</label>
        <input type="text" id="user_phone" name="user_phone" required><br>

        <input type="submit" value="Save changes">
    </form>

    <!-- Fiók törlése űrlap -->
    
    
    <form method="POST" action="profiledelete.php" class="container">
    <h2>Profile Delete</h2>
    <p>With this option your profile is going to deleted and can't restore it!</p>
        <label for="delete_account">Delete confirmation:</label>
        <input type="checkbox" id="delete_account" name="delete_account" required><br>

        <input type="submit" value="Profile delete">
    </form>

    <!-- Jelszóváltás kérése űrlap -->
    
    <form action="profilepwchange.php" method="POST" class="container">
    <h2>Password change</h2>
    <p>If you forgot your password you can send a request to change it.</p>
    <label for="current_password">Jelenlegi jelszó:</label>
        <input type="password" id="current_password" name="current_password" required><br>

        <label for="new_password">Új jelszó:</label>
        <input type="password" id="new_password" name="new_password" required><br>
        
        <input type="submit" value="Password change request">
    </form>
</body>
</html>