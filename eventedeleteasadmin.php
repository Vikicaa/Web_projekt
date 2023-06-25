<?php

// Check if the event ID is provided
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];

    // Connect to the database
    include("db_config.php");

    // Delete the user from the database
    $query = "DELETE FROM events WHERE event_id = $event_id";
    $result = $connection->query($query);

    if ($result) {
        echo "Event deleted successfully.";
    } else {
        echo "Error deleting event: " . $connection->error;
    }

    // Close the database connection
    $connection->close();
} else {
    echo "Invalid event ID.";
}
?>