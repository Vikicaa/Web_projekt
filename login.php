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
</header>
<h2>Login</h2>
            <form action = loginner.php method = "POST">
                <label for="user_name">Username:</label>
                <input type="text" name="user_name" required><br>

                <label for="user_password">Password:</label>
                <input type="password" name="user_password" required><br><br>

                <button type="submit" onclick="login()">Login</button>
                <button type="button" onclick="hideLoginPopup()">Close</button>
				<button type="button" onclick="parent.location='adminlogin.php'">Admin</button>
            </form>
</body>
</html>