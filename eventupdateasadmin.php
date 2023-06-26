<!DOCTYPE html>
<html>
<head>
    <title>Event Management</title>
    <link rel="icon" type="image/png" sizes="16x16" href="images/icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
    <link rel="stylesheet" type="text/css" href="CSS/admin.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <style>
    </style>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <?php
    // This script handles the event update process
    // Connect to the database
    include("db_config.php");

    // Check if the event ID is provided
    if (isset($_GET['event_id'])) {
        $event_id = $_GET['event_id'];

        // Retrieve the event details from the database
        $query = "SELECT * FROM events WHERE event_id = $event_id";
        $result = $connection->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $event_name = $row['event_name'];
            $event_date = $row['event_date'];
            $event_location = $row['event_location'];
            $event_price = $row['event_price'];

            // Display a form for updating the event details
            echo '<h2>Update Event Details</h2>';
            echo '<form action="updateevent.php" method="POST" class="container">';
            echo '    <input type="hidden" name="event_id" value="' . $event_id . '">';
            echo '    <label for="event_name">Event Name:</label>';
            echo '    <input type="text" name="event_name" value="' . $event_name . '">';
            echo '    <br>';
            echo '    <label for="event_date">Date:</label>';
            echo '    <input type="date" name="event_date" value="' . $event_date . '">';
            echo '    <br>';
            echo '    <label for="event_location">Location:</label>';
            echo '    <input type="text" name="event_location" value="' . $event_location . '">';
            echo '    <br>';
            echo '    <label for="event_price">Price:</label>';
            echo '    <input type="number" name="event_price" value="' . $event_price . '">';
            echo '    <br>';
            echo '    <input type="submit" value="Update">';
            echo '</form>';
        } else {
            echo "Event not found.";
        }
    } else {
        echo "Invalid event ID.";
    }

    // Close the database connection
    $connection->close();
    ?>
</body>
</html>
