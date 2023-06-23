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
    height: 620px;
    }
  </style>
</head>
    <body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
            <form action = admin.php>
                <h3>Login Here</h3>
                <label for="admin_name">Username:</label>
                <input type="text" name="admin_name" placeholder="Admin:"  id="username"required><br>

                <label for="admin_password">Password:</label>
                <input type="password" name="admin_password" placeholder="Password:" id="password" required><br><br>

                <button type="submit" onclick="admin()">Log In</button>
                <button type="button" onclick="goBack()">Back</button>
				
            </form>

    </body>
</html>