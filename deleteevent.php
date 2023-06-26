<?php
session_start();

if (isset($_GET["event_id"])) {
    $event_id = $_GET["event_id"];
    $_SESSION["event_id"] = $event_id;
}
// Az adatbázis kapcsolódás konfigurációja
include ("db_config.php");

global $connection;

// Esemény törlése
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_event"]) && isset($_SESSION["event_id"])) {
    $event_id = $_SESSION["event_id"];

    // Esemény törlése az adatbázisból
    $sql = "DELETE FROM events WHERE event_id='$event_id'";

    if ($connection->query($sql) === TRUE) {
        echo "The event is deleted.";
        header('Location: userevents.php');
    } else {
        echo "Something went wrong while deleting the event: " . $connection->error;
    }
}

// Adatbázis kapcsolat bezárása
$connection->close();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Rendezvényszervezés</title>
	<link rel="icon" type="image/png" sizes="16x16" href="images/icon.png">
  	<link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
	<link rel="stylesheet" type="text/css" href="CSS/profil.css"> 
	<link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
	<script src="JS\script.js"></script>

</head>
<body>
    

<form method="POST" action="" class="container">
    <h2>Event Delete</h2>
    <p>With this option your profile is going to deleted and can't restore it!</p>
        <label for="delete_event">Delete confirmation:</label>
        <input type="checkbox" id="delete_event" name="delete_event" required><br>

        <input type="submit" value="Event delete">
    </form>

</body>
</html>