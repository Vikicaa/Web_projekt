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
elseif (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {

	$user_name = $_SESSION['user_name'];
	// User is logged in as regular user
	include 'userheader.php';
	echo '<h1>Welcome,  ' . $user_name . '!</h1>';
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
			<h2>Közelgő Rendezvények</h2>
			<ul>
				<li>
					<h3>XXI. Évforduló Ünnepség</h3>
					<p>Dátum: 2023.06.05</p>
					<p>Leírás: Az alapítás 21. évfordulója alkalmából szeretettel meghívjuk Önt és kedves családját a jubileumi ünnepségünkre.</p>
				</li>
				<li>
					<h3>Éves Karácsonyi Party</h3>
					<p>Dátum: 2023.12.22</p>
					<p>Leírás: Szeretettel meghívjuk minden munkatársunkat és családjukat az éves karácsonyi ünnepségünkre.</p>
				</li>
			</ul>
		</section>
	</main>

	

</body>
</html>

<?php
include 'footer.php';
?>
