<!DOCTYPE html>
<html>
<head>
	<title>Rendezvényszervezés</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>
		<h1>Rendezvényszervezés</h1>
		<nav>
			<ul>
				<li><a href="home_page.php">Home Page</a></li>
				<li><a href="events.php">Events</a></li>
				<li><a href="about_us.php">About Us</a></li>
				<li><a href="#" onclick="showLoginPopup()">Login</a></li>
            	<li><a href="#" onclick="showRegistrationPopup()">Register</a></li>
			</ul>
		</nav>
	</header>

	<main>
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
                <input type="name" id="user_name" required>

                <label for="user_password">Password:</label>
                <input type="password" id="user_password" required>

                <button type="button" onclick="login()">Login</button>
                <button type="button" onclick="hideLoginPopup()">Close</button>
				<button type="button" onclick="showAdminPopup(), hideLoginPopup()">Admin</button>
            </form>
        </div>
    </div>

	<div id="registrationPopup" class="popup" action="register.php">
        <div class="popup-content">
            <h2>Register</h2>
            <form>
                <label for="user_name">Username:</label>
                <input type="text" id="user_name" name="user_name" required>

                <label for="user_password">Password:</label>
                <input type="password" id="user_password" name="user_password" required><br>

				<label for="user_email">Email:</label>
                <input type="email" id="user_email" name="user_email" required><br>

				<label for="user_phone">Phone:</label>
                <input type="number" id="user_phone" name="user_phone" required>

                <button type="button" onclick="register()">Register</button>
                <button type="button" onclick="hideRegistrationPopup()">Close</button>
            </form>
        </div>
    </div>

	<div id="adminPopup" class="popup" action="admin.php">
        <div class="popup-content">
            <h2>Admin</h2>
            <form>
                <label for="admin_name">Username:</label>
                <input type="text" id="admin_name" required>

                <label for="admin_password">Password:</label>
                <input type="password" id="admin_password" required>

                <button type="button" onclick="admin()">Log In</button>
                <button type="button" onclick="hideAdminPopup()">Close</button>
				
            </form>
        </div>
    </div>



    <script src="JS\script.js"></script>

	<footer>
		<p>Kapcsolat: info@rendezvenyszervezes.hu</p>
		<p>Telefon: +36 30 123 4567</p>
	</footer>

</body>
</html>
