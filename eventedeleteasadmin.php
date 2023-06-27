<?php

// Check if the event ID is provided
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];

    // Connect to the database
    include("db_config1.php");
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the delete statement
    $query = "DELETE FROM events WHERE event_id = :event_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':event_id', $event_id);

    if ($stmt->execute()) {
        echo "Event deleted successfully.";
        header('Location: events.php');
        exit();
    } else {
        echo "Error deleting event: " . $stmt->errorInfo()[2];
    }

    // Close the database connection
    $connection = null;
} else {
    echo "Invalid event ID.";
}
?>
