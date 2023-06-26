<?php
session_start();

include("db_config.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM invited";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $invited_token = $row['invited_token'];
    }
} else {
    echo "<div class='events'>There are no invited.</div>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_name = $_POST["event_select"];
    $recipients = $_POST["recipients"]; // Beírt címzett email címek
    $recipient_emails = explode(",", $recipients); // Címzett email címek tömbbe szétválasztása

    // Az esemény azonosítójának lekérdezése az esemény neve alapján
    $event_query = "SELECT event_id FROM events WHERE event_name = '$event_name'";
    $event_result = $connection->query($event_query);

    if ($event_result->num_rows > 0) {
        $event_row = $event_result->fetch_assoc();
        $event_id = $event_row['event_id'];

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'blackandwhitedeveloperstudio@gmail.com'; //Your gmail
            $mail->Password = 'qhkzescyxvyxfqho'; // Your gmail app pw
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('blackandwhitedeveloperstudio@gmail.com'); //your email
            $mail->isHTML(true);
            $subject = $_POST["subject"];
            $message = $_POST["message"];

            foreach ($recipient_emails as $email) {
                $email = trim($email); // Felesleges szóközök eltávolítása
                $mail->addAddress($email);

                $mail->Subject = $subject;
                $mail->Body = $message;

                $mail->send();

                $invited_token++;

                // A küldött meghívó rögzítése az "invited" táblában
                $insertQuery = "INSERT INTO invited (invited_token, invited_mail, event_id, user_id) VALUES ('$invited_token', '$email', '$event_id', '$user_id')";
                $connection->query($insertQuery);
            }
        } catch (Exception $e) {
            echo "Something went wrong while sending email: " . $mail->ErrorInfo . "<br>";
        }
    } else {
        echo "Events not found with this username.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Email sending</title>
    <link rel="stylesheet" type="text/css" href="CSS/login.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <script src="JS\script.js"></script>
    <style>
        form {
            height: 85%;
        }
    </style>
</head>
<body>
<div class="background">
    <div class="shape"></div>
    <div class="shape"></div>
    <div class="shape"></div>
</div>

<h1>Email sending</h1>

<form action="" method="POST" class="container">
    <label for="recipients">Recipient email addresses (comma separated):</label>
    <input type="text" name="recipients" required><br>

    <label for="subject">Subject:</label>
    <input type="text" name="subject" required><br>

    <label for="message">Message:</label>
    <textarea name="message" rows="6" class="message" required></textarea><br>

    <?php
    $sql1 = "SELECT * FROM events";
    $result1 = $connection->query($sql1);

    if ($result1->num_rows > 0) {
        echo "<select name='event_select' class='select_opction'>";
        while ($row = $result1->fetch_assoc()) {
            $event_name = $row['event_name'];
            echo "<option name='$event_name'>$event_name</option>";
        }
        echo "</select>";
    } else {
        echo "<div class='events'>There are no events.</div>";
    }
    $connection->close();
    ?>

    <button class="button" type="submit">Send</button>
    <button class="button" type="button" onclick="parent.location='userevents.php'">Back</button>
</form>

</body>
</html>
