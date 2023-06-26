<!DOCTYPE html>
<html>
<head>
    <title>Események kezelése</title>
    <link rel="icon" type="image/png" sizes="16x16" href="images/icon.png">
  	<link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
	<link rel="stylesheet" type="text/css" href="CSS/changeevent2.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
	<script src="JS\script.js"></script>

</head>
<body>
<div class="background">
        <div class="shape"></div>
		<div class="shape"></div>
        <div class="shape"></div>
    </div>
<main >
	<div class="eventdiv">
            <h1>Események kezelése</h1>
            <h2>Események listája</h2>
        <div class="head">
          
            <button class="button" type="button" onclick="openUserEventsSite()">Back</button>
        </div>
    <?php
	session_start();
	// Az adatbázis kapcsolódása
	include ("db_config.php");
    
    $user_id = $_SESSION['user_id'];
	// Események lekérdezése az adatbázisból
	$sql = "SELECT * FROM events WHERE user_id = $user_id";
	$result = $connection->query($sql);

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$event_id=$row['event_id'];
			echo $event_id;
			echo "<a href='changeevent.php?event_id=" . $event_id . "'>" . $row["event_name"] . "</a>";
    		echo "<div class='events'>" . "Date: " . $row["event_date"] . " - Location: " . $row["event_location"] . " - Price: " . $row["event_price"] . "</div>";

			$_SESSION['event_id'] = $event_id;
		}
	} else {
		echo "<div class='events'>There are no events.</div>";
	}
	
	// Adatbázis kapcsolat bezárása
	$connection->close();
	?>

</div>
</main>

	
</body>
</html>
