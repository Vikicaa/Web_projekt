<?php
// This script handles the user deletion process

// Check if the user ID is provided
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Connect to the database
    include("db_config.php");

    // Delete the user from the database
    $query = "DELETE FROM users WHERE user_id = $userId";
    $result = $connection->query($query);

    if ($result) {
        echo "User deleted successfully.";
    } else {
        echo "Error deleting user: " . $connection->error;
    }

    // Close the database connection
    $connection->close();
} else {
    echo "Invalid user ID.";
}
?>
