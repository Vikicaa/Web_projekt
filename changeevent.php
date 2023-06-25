<?php
// Az adatbázis kapcsolódás konfigurációja
include ("db_config.php");

// Esemény módosítása
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_event"])) {
    $event_id = $_POST["event_id"];
    $event_name = $_POST["event_name"];
    $event_date = $_POST["event_date"];
	$event_location = $_POST["event_location"];
	$event_price = $_POST["event_price"];

    // Esemény módosítása az adatbázisban
    $sql = "UPDATE events SET event_name='$event_name', event_date='$event_date', event_location='$event_location', event_price='$event_price' WHERE id='$event_id'";

    if ($connection->query($sql) === TRUE) {
        echo "The event is updated.";
    } else {
        echo "Something went wrong while updating the event: " . $connection->error;
    }
}

$connection->close();
?>