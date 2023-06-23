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
            <form action = admin.php>
                <label for="admin_name">Username:</label>
                <input type="text" name="admin_name" required><br>

                <label for="admin_password">Password:</label>
                <input type="password" name="admin_password" required><br><br>

                <button type="submit" onclick="admin()">Log In</button>
                <button type="button" onclick="hideAdminPopup()">Close</button>
				
            </form>

    </body>
</html>