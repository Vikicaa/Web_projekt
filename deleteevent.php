<?php
// Az adatbázis kapcsolódás konfigurációja
include ("db_config.php");

// Esemény törlése
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_event"])) {
    $event_id = $_POST["event_id"];

    // Esemény törlése az adatbázisból
    $sql = "DELETE FROM events WHERE id='$event_id'";

    if ($connection->query($sql) === TRUE) {
        echo "The event is deleted.";
    } else {
        echo "Something went wrong while deleting the event: " . $connection->error;
    }
}

// Adatbázis kapcsolat bezárása
$connection->close();
?>