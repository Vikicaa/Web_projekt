<!DOCTYPE html>
<html>
<head>
	<title>Rendezvényszervezés</title>
	<link rel="icon" type="image/png" sizes="16x16" href="images/icon.png">
  	<link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
	<link rel="stylesheet" type="text/css" href="CSS/style.css">
	<script src="JS\script.js"></script>
</head>
<body>
<header>
	<div class="logo">
    	<img src="images/logo2.0.png" alt="Logo">
  	</div>
  <div class="menu-toggle"></div>
  <nav>
    <ul class="menu-links">
      <li><a href="home_page.php">Home Page</a></li>
      <li><a href="events.php">Events</a></li>
      <li><a href="about_us.php">About Us</a></li>
      <li><a href="" onclick="showLoginPopup()">Login</a></li>
      <li><a href="register.php">Register</a></li>
    </ul>
  </nav>
</header>

<nav class="dropdown-menu">
  <ul class="menu-links">
    <li><a href="home_page.php">Home Page</a></li>
    <li><a href="events.php">Events</a></li>
    <li><a href="about_us.php">About Us</a></li>
    <li><a href="#" onclick="showLoginPopup()">Login</a></li>
    <li><a href="register.php">Register</a></li>
  </ul>
</nav>

            <h2>Register</h2>
            <form action = register.php method = "POST">
                <label for="user_name">Username:</label>
                <input type="text" id="user_name" name="user_name" required><br>

                <label for="user_password">Password:</label>
                <input type="password" id="user_password" name="user_password" required><br>

				<label for="user_email">Email:</label>
                <input type="email" id="user_email" name="user_email" required><br>

				<label for="user_phone">Phone:</label>
                <input type="number" id="user_phone" name="user_phone" required><br><br>

                <button type="submit" onclick="register()">Register</button>
                <button type="button" onclick="hideRegistrationPopup()">Close</button>
            </form>

            <footer>
		<p>Kapcsolat: info@rendezvenyszervezes.hu</p>
		<p>Telefon: +36 30 123 4567</p>
	</footer>

</body>
</html>