<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Felhasználói profil</title>
	<link rel="icon" type="image/png" sizes="16x16" href="images/icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
  <link rel="stylesheet" type="text/css" href="CSS/login.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
  <style>
  form{
    height: 50%;
    }
    </style>
</head>
<body>
    
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>  
    <!-- Jelszóváltás kérése űrlap -->
    
    <form action="profilepwchange.php" method="POST" >
        <h3>Password change</h3>

        <label for="current_password">Jelenlegi jelszó:</label>
        <input type="password" id="current_password" name="current_password" required><br>

        <label for="new_password">Új jelszó:</label>
        <input type="password" id="new_password" name="new_password" required><br>
        
        <button type="submit" value="Password change request">Change Password</button>
    </form>
</body>
</html>