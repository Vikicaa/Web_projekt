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

include 'adminheader.php';


    if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin']) {
        // User is logged in as admin
        echo '<h1>Welcome, admin!</h1>';
    }


?>
	<div class="background">
        <div class="shape"></div>
		<div class="shape"></div>
        <div class="shape"></div>
    </div>
	<main >
	<div class="eventdiv">

	<h2>Events List</h2>
	
	<?php
	// Az adatbázis kapcsolódása
	include ("db_config.php");

	// Események lekérdezése az adatbázisból
	$sql = "SELECT * FROM events";
	$result = $connection->query($sql);

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$event_id=$row['event_id'];
			echo "<h2>" . $row["event_name"] . "</h2>";
			echo "<div class='events'>" . "Date: " . $row["event_date"] . " - Location: " . $row["event_location"] . " - Price: " . $row["event_price"] . "</div>";
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
