<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Rendezvényszervezés</title>
	<link rel="icon" type="image/png" sizes="16x16" href="images/icon.png">
  	<link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
	<!-- <link rel="stylesheet" type="text/css" href="CSS/style.css"> -->
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
	
}
else{
	include 'header.php';
}
?>
<main>
<div class="background">
        <div class="shape"></div>
		<div class="shape"></div>
        <div class="shape"></div>
    </div>
	<section class="container">
	<h1>Event management</h1><br>

	<button type="button" onclick="parent.location='addevent.php'">Create Event</button>
    <button type="button" onclick="parent.location='changeevent2.php'">Change Event</button>
	<button type="button" onclick="parent.location='deleteevent.php'">Delete Event</button>


<!-- Események listázása -->
<h2>Events List</h2>
<ul>
	<?php
	// Az adatbázis kapcsolódási adataidhoz és az adatbázis sémádhoz kell igazítani.
	include ("db_config.php");

	// Események lekérdezése az adatbázisból
	$sql = "SELECT * FROM events";
	$result = $connection->query($sql);

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			
			echo "<li>" . $row["event_name"] . " - " . $row["event_date"] . " - " . $row["event_location"] . " - " . $row["event_price"] . "</li>";
		}
	} else {
		echo "<li>There are no events.</li>";
	}
	
	// Adatbázis kapcsolat bezárása
	$connection->close();
	?>
</ul>
</main>

</body>
</html>

<?php
include 'footer.php';
?>
