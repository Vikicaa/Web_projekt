<?php
// This script handles the user update form submission

// Check if the form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $userId = $_POST['userid'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Connect to the database
    include("db_config.php");

    // Update the user details in the database
    $query = "UPDATE users SET user_name = '$username', user_email = '$email' WHERE user_id = $userId";
    $result = $connection->query($query);

    if ($result) {
        header('Location: users.php');
    } else {
        echo "Error updating user: " . $connection->error;
    }

    // Close the database connection
    $connection->close();
} else {
    echo "Invalid request.";
}
?>
