<?php
// Adatbázis konfiguráció
$host = "localhost";
$dbname = "bw";
$username = "bw";
$password = "4qEA1dED43ObX44";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
];

// Ellenőrizze, hogy az esemény azonosítója (event_id) át lett-e adva a kérésben
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];

    try {
        // Adatbáziskapcsolat létrehozása
        $connection = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, $options);

        // Esemény törlése az adatbázisból
        $query = "DELETE FROM events WHERE event_id = ?";
        $statement = $connection->prepare($query);
        $statement->execute([$event_id]);

        echo "Event deleted successfully.";
    } catch (PDOException $e) {
        echo "Error deleting event: " . $e->getMessage();
    } finally {
        // Adatbáziskapcsolat bezárása
        $connection = null;
    }
} else {
    echo "Invalid event ID.";
}
?>
