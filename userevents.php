<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Rendezvényszervezés</title>
    <link rel="icon" type="image/png" sizes="16x16" href="images/icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
    <link rel="stylesheet" type="text/css" href="CSS/userevents.css"> 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <script src="JS\script.js"></script>

</head>
<body>
<?php

// Check if the user is logged in
if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] === true) {
    include 'adminheader.php';
}
elseif (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {

    $user_name = $_SESSION['user_name'];
    // User is logged in as a regular user
    include 'userheader.php';
    
}
else{
    include 'header.php';
}
?>
<div class="wrapper">
<main class="content" style="height: 90vh;">
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="manager" style="text-align: center;">
        <h1>Create, Modify or Delete Your Own Event</h1>
        <div class="buttons">
            <button type="button" onclick="parent.location='addevent.php'">Create Event</button>
            <button type="button" onclick="parent.location='changeevent2.php'">Change Event</button>
            <button type="button" onclick="parent.location='deleteevent2.php'">Delete Event</button>
        </div>
        <div class="buttons">
            <button type="button" onclick="parent.location='invitesend.php'">Send Invite</button>
            <button type="button" onclick="parent.location='invitelist.php'">Invited List</button>
        </div>
    </div>
    
</main>
</div>

<footer class="footer">
    <div class="contact">
        <h3>Elérhetőségek</h3>
        <ul>
            <li><a href="mailto:info@example.com">info@example.com</a></li>
            <li><a href="tel:+1234567890">+1234567890</a></li>
        </ul>
    </div>
    <div class="social-media">
        <h3>Közösségi média</h3>
        <ul>
            <li><a href="https://www.facebook.com/example">Facebook</a></li>
            <li><a href="https://twitter.com/example">Twitter</a></li>
            <li><a href="https://www.instagram.com/example">Instagram</a></li>
        </ul>
    </div>
    <div class="address">
        <h3>Cím</h3>
        <p>1234 Példa város, Példa utca 1.</p>
    </div>
</footer>
</body>
</html>
