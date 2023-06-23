<!DOCTYPE html>
<html>
<head>
	<title>Rendezvényszervezés</title>
	<link rel="icon" type="image/png" sizes="16x16" href="images/icon.png">
  	<link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
	<link rel="stylesheet" type="text/css" href="CSS/style.css">
	<link rel="stylesheet" type="text/css" href="CSS/login.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
	<script src="JS\script.js"></script>
</head>
<body>

<?php
include 'header.php'
?>
	<main>
	<div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
		<section>
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

		<section>
			<h2>Rólunk</h2>
			<p>Mi egy nagy tapasztalattal rendelkező rendezvényszervező cég vagyunk. Széles körű szolgáltatásaink közé tartoznak a konferenciák, céges rendezvények, esküvők és egyéb ünnepségek szervezése. </p>
		</section>
	</main>



	<div id="loginPopup" class="popup">
        <div class="popup-content">
            <h2>Login</h2>
            <form>
                <label for="user_name">Username:</label>
                <input type="name" id="user_name" required><br>

                <label for="user_password">Password:</label>
                <input type="password" id="user_password" required><br><br>

                <button type="submit" onclick="login()">Login</button>
                <button type="button" onclick="hideLoginPopup()">Close</button>
				<button type="button" onclick="showAdminPopup(), hideLoginPopup()">Admin</button>
            </form>
        </div>
    </div>


	<div id="adminPopup" class="popup" action="admin.php">
        <div class="popup-content">
            <h2>Admin</h2>
            
        </div>
    </div>

	<footer>
		<p>Kapcsolat: info@rendezvenyszervezes.hu</p>
		<p>Telefon: +36 30 123 4567</p>
	</footer>

</body>
</html>
