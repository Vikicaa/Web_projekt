<?php

session_start();

if(isset($_POST['send'])) {
    $forgorpwuser_email = $_POST['forgorpwuser_email'];
    $_SESSION['forgorpwuser_email'] = $forgorpwuser_email;
}

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
    height: 40%;
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

        <form action = "forgotpwsend.php" method = "POST">

			<h3>Forgot Password?</h3>

                <label for="forgorpwuser_email">User Email:</label>
                <input type="email" placeholder="Email:" name="forgorpwuser_email" id="forgorpwuser_email" required><br>
                
                <button type="submit" name="send">Send Email</button>
                
        </form>
</body>
</html>