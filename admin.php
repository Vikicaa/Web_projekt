<?php

session_start();

include("db_config.php");

// Check if the admin is already logged in
if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] === true) {
    // Admin is already logged in, redirect to the admin home page or any other logged-in page
    header('Location: admin_home.php');
    exit();
}

// Admin login form submission
if (isset($_POST['admin_name']) && isset($_POST['admin_password'])) {
    $admin_name = $_POST['admin_name'];
    $admin_password = $_POST['admin_password'];
    global $connection;

    // Check admin credentials in the database
    $sql = "SELECT * FROM admin WHERE admin_name = '$admin_name' AND admin_password = '$admin_password'";
    $result = $connection->query($sql);

    // Check if there is a match
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['admin_password'];

        if ($admin_password === $storedPassword) {
            $_SESSION['admin_loggedin'] = true;

            // Redirect to the admin home page
            header('Location: admin_home.php');
            exit();
        } else {
            // Incorrect admin credentials
            echo "Incorrect admin password!";
        }
    } else {
        // Incorrect admin credentials
        echo "Incorrect admin username!";
    }
}
?>
