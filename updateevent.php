<?php
// This script handles the user update form submission

// Check if the form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $event_id = $_POST['event_id'];
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $event_location = $_POST['event_location'];
    $event_price = $_POST['event_price'];

    // Connect to the database
    include("db_config.php");

    // Update the user details in the database
    $query = "UPDATE events SET event_name = '$event_name', event_date = '$event_date', event_location = '$event_location', event_price = '$event_price' WHERE event_id = $event_id";
    $result = $connection->query($query);

    if ($result) {
        header('Location: events.php');
    } else {
        echo "Error updating user: " . $connection->error;
    }

    // Close the database connection
    $connection->close();
} else {
    echo "Invalid request.";
}
?>
