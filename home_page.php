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
session_start();

include 'header.php';

// Check if the user is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // User is logged in
    if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] === true) {
        // User is logged in as admin
        echo '<h1>Welcome, admin user!</h1>';
        echo '<a href="logout.php" class="logout-btn">Log Out</a>'; // Log out button
    } else {
        // User is logged in as regular user
        echo '<h1>Welcome, regular user!</h1>';
        echo '<a href="logout.php" class="logout-btn">Log Out</a>'; // Log out button
    }
} else {
    // User is not logged in
    echo '<h1>Welcome, guest user!</h1>';
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

		<section class="container" >
			<h2>Rólunk</h2>
			<p>Mi egy nagy tapasztalattal rendelkező rendezvényszervező cég vagyunk. Széles körű szolgáltatásaink közé tartoznak a konferenciák, céges rendezvények, esküvők és egyéb ünnepségek szervezése. </p>
		</section>
	</main>

</body>
</html>
