<!DOCTYPE html>
<html>
<head>
    <title>Felhasználókezelés</title>
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
// This script handles the user update process
// Check if the user ID is provided
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Connect to the database
    include("db_config.php");

    // Retrieve the user details from the database
    $query = "SELECT * FROM users WHERE user_id = $userId";
    $result = $connection->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row['user_name'];
        $email = $row['user_email'];

        // Display a form for updating the user details
        echo '<h2>Update User Details</h2>';
        echo '<form action="updateuser.php" method="POST" class="container">';
        echo '    <input type="hidden" name="userid" value="' . $userId . '">';
        echo '    <label for="username">Username:</label>';
        echo '    <input type="text" name="username" value="' . $username . '">';
        echo '    <br>';
        echo '    <label for="email">Email:</label>';
        echo '    <input type="email" name="email" value="' . $email . '">';
        echo '    <br>';
        echo '    <input type="submit" value="Update">';
        echo '</form>';
    } else {
        echo "User not found.";
    }

    // Close the database connection
    $connection->close();
} else {
    echo "Invalid user ID.";
}
?>
</body>
</html>