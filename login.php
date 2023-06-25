<?php

session_start();

$errors = array();

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
            $errors['user_password'] = "Incorrect email or password!";
        }
    } else {
        // Helytelen felhasználói adatok
        $errors['user_email'] = "Incorrect email or password!";
    }
}

// Store the errors in the session
$_SESSION['errors'] = $errors;

?>
<!DOCTYPE html>
<html>
<head>
	<title>Rendezvényszervezés</title>
	<link rel="icon" type="image/png" sizes="16x16" href="images/icon.png">
  	<link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">

	<link rel="stylesheet" type="text/css" href="CSS/login.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
	<script src="JS\script.js"></script>
    <style>
  
    form{
    height: 80%;
    }
    .error {
    font-family: 'Poppins',sans-serif;
    color: red;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
    font-weight: bold;
}
  </style>
</head>
<body>

<div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

        <form action = "" method = "POST">

			<h3>Login Here</h3>

                <label for="user_email">User Email:</label>
                <input type="email" placeholder="Email:" name="user_email" id="user_email" required><br>
                

                <label for="user_password">Password:</label>
                <input type="password" placeholder="Password:" id="password" name="user_password" required><br><br>
                <?php if(isset($_SESSION['errors']['user_password'])) { echo '<p class="error">'.$_SESSION['errors']['user_password'].'</p>'; } ?><br>
                <?php if(isset($_SESSION['errors']['user_email'])) { echo '<p class="error">'.$_SESSION['errors']['user_email'].'</p>'; } ?><br>
                <button type="submit" onclick="login()">Log in</button>
                <button type="button" onclick="openRegSite()">Sign up</button>
				<button type="button" onclick="parent.location='adminlogin.php'">Admin</button>
                
            </form>
</body>
</html>