<?php
// Adatbázis konfiguráció beolvasása
require_once "db_config1.php";

// Ellenőrizze, hogy az esemény azonosítója (event_id) át lett-e adva a kérésben
if (isset($_POST['event_id'])) {
    $event_id = $_POST['event_id'];

    // Ellenőrizze, hogy az új esemény adatokat (név, dátum, helyszín, ár) átadták-e a kérésben
    if (isset($_POST['event_name']) && isset($_POST['event_date']) && isset($_POST['event_location']) && isset($_POST['event_price'])) {
        $event_name = $_POST['event_name'];
        $event_date = $_POST['event_date'];
        $event_location = $_POST['event_location'];
        $event_price = $_POST['event_price'];

        try {
            // Adatbáziskapcsolat létrehozása
            $connection = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, $options);

            // Esemény módosítása az adatbázisban
            $query = "UPDATE events SET event_name = ?, event_date = ?, event_location = ?, event_price = ? WHERE event_id = ?";
            $statement = $connection->prepare($query);
            $statement->execute([$event_name, $event_date, $event_location, $event_price, $event_id]);

            echo "Event updated successfully.";
        } catch (PDOException $e) {
            echo "Error updating event: " . $e->getMessage();
        } finally {
            // Adatbáziskapcsolat bezárása
            $connection = null;
        }
    } else {
        echo "Missing event details.";
    }
} else {
    echo "Invalid event ID.";
}
?>
