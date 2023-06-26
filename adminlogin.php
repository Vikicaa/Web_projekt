<?php

session_start();

$errors = array();

include("db_config.php");

// Check if the admin is already logged in
if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] === true) {
    // Admin is already logged in, redirect to the admin home page or any other logged-in page
    header('Location: admin_home.php');
    exit();
}

// Admin login form submission
if (isset($_POST['admin_name']) && isset($_POST['admin_password'])) {
    $admin_name = $_POST['admin_name'];
    $admin_password = $_POST['admin_password'];
    global $connection;

    // Check admin credentials in the database
    $sql = "SELECT * FROM admin WHERE admin_name = '$admin_name' AND admin_password = '$admin_password'";
    $result = $connection->query($sql);

    // Check if there is a match
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['admin_password'];

        if ($admin_password === $storedPassword) {
            $_SESSION['admin_loggedin'] = true;

            // Redirect to the admin home page
            header('Location: admin_home.php');
            exit();
        } else {
            // Incorrect admin credentials
            $errors['admin_password'] = "Incorrect admin username or password!";
        }
    } else {
        // Incorrect admin credentials
        $errors['admin_name'] = "Incorrect admin username or password!";
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
    height: 650px;
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
                <label for="admin_name">Username:</label>
                <input type="text" name="admin_name" placeholder="Admin:"  id="username"required><br>

                <label for="admin_password">Password:</label>
                <input type="password" name="admin_password" placeholder="Password:" id="password" required><br><br>

                <?php if(isset($_SESSION['errors']['admin_name'])) { echo '<p class="error">'.$_SESSION['errors']['admin_name'].'</p>'; } ?><br>
                <?php if(isset($_SESSION['errors']['admin_password'])) { echo '<p class="error">'.$_SESSION['errors']['admin_password'].'</p>'; } ?><br>
                
                <button type="submit" onclick="admin()">Log In</button>
                c
				
            </form>

    </body>
</html>