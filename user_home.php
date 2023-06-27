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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

	<main >
	<div class="eventdiv">

	
	<?php
	// Az adatbázis kapcsolódása
	include ("db_config.php");

	// Események lekérdezése az adatbázisból
	$sql = "SELECT * FROM events";
	$result = $connection->query($sql);

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$event_id=$row['event_id'];
			echo "<div class='events'><h2>" . $row["event_name"] . "</h2>";
			echo "" . "Date: " . $row["event_date"] . " <br> Location: " . $row["event_location"] . " <br> Price: " . $row["event_price"] . " din</div>";
		}
	} else {
		echo "<div class='events'>There are no events.</div>";
	}
	$_SESSION['event_id'] = $event_id;
	// Adatbázis kapcsolat bezárása
	$connection->close();
	?>

</div>
</main>

	

</body>
</html>

<?php
include 'footer.php';
?>
