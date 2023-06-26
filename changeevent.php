<?php
session_start();
// Az adatbázis kapcsolódás konfigurációja
include ("db_config.php");

// Esemény módosítása
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["event_id"])) {
    $event_id = $_SESSION["event_id"];
    $event_name = $_POST["event_name"];
    $event_date = $_POST["event_date"];
	$event_location = $_POST["event_location"];
	$event_price = $_POST["event_price"];

    // Esemény módosítása az adatbázisban
    $sql = "UPDATE events SET event_name='$event_name', event_date='$event_date', event_location='$event_location', event_price='$event_price' WHERE event_id='$event_id'";

    if ($connection->query($sql) === TRUE) {
        echo "The event is updated.";
    } else {
        echo "Something went wrong while updating the event: " . $connection->error;
    }
}

$connection->close();
?>

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
			height:85%;
		}
	</style>
</head>
<body>
<div class="background">
        <div class="shape"></div>
		<div class="shape"></div>
        <div class="shape"></div>
</div>

<h1>Change event details</h1>

<form action="" method="POST" class="container">
	<label for="event_name">Event name:</label>
	<input type="text" name="event_name" required><br>

	<label for="event_date">Event date:</label>
	<input type="date" name="event_date" required><br>

	<label for="event_location">Event location:</label>
	<input type="text" name="event_location" required><br>

	<label for="event_price">Event price:</label>
	<input type="number" name="event_price" required><br>

	<button type="submit">Change Event Details</button>
	<button class="button" type="button" onclick="openChangeEvent2Site()">Back</button>
</form>

</body>
</html>