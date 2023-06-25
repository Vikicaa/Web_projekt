<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Rendezvényszervezés</title>
	<link rel="icon" type="image/png" sizes="16x16" href="images/icon.png">
  	<link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
	<link rel="stylesheet" type="text/css" href="CSS/style.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
	<script src="JS\script.js"></script>
</head>
<body>

<?php

// Check if the user is logged in
if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] === true) {
	include 'adminheader.php';
}
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {

	$user_name = $_SESSION['user_name'];
	// User is logged in as regular user
	include 'userheader.php';
	
}
else{
	include 'header.php';
}
?>
<div class="background">
        <div class="shape"></div>
		<div class="shape"></div>
        <div class="shape"></div>
    </div>
	<main>

		<section class="container">
			<h2>Rólunk</h2>
			<p>Mi egy nagy tapasztalattal rendelkező rendezvényszervező cég vagyunk. Széles körű szolgáltatásaink közé tartoznak a konferenciák, céges rendezvények, esküvők és egyéb ünnepségek szervezése. </p>
		</section>
	</main>

	<footer>
		<p>Kapcsolat: info@rendezvenyszervezes.hu</p>
		<p>Telefon: +36 30 123 4567</p>
	</footer>

</body>
</html>
