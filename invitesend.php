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
			$invited_token=$row['invited_token'];
			
		}
	} else {
		echo "<div class='events'>There are no invited.</div>";
	}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION["event_id"])) {
        $event_id = $_SESSION["event_id"];
        $recipients = $_POST["recipients"]; // Beírt címzett email címek
        $recipient_emails = explode(",", $recipients); // Címzett email címek tömbbe szétválasztása

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'blackandwhitedeveloperstudio@gmail.com'; //Your gmail
            $mail->Password = 'qhkzescyxvyxfqho'; // Your gmail app pw
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('blackandwhitedeveloperstudio@gmail.com'); //you email
            $mail->isHTML(true);
            $subject = $_POST["subject"];
            $message = $_POST["message"];
            
            foreach ($recipient_emails as $email) {
                $email = trim($email); // Felesleges szóközök eltávolítása
                $mail->addAddress($email);

                $mail->Subject = $subject;
                $mail->Body = $message;

                $mail->send();

                echo "Sikeresen elküldve: " . $email . "<br>";
                $invited_token++;
                // A küldött meghívó rögzítése a "invited" táblában
                $insertQuery = "INSERT INTO invited (invited_token,invited_mail,event_id,user_id) VALUES ('$invited_token','$email','$event_id','$user_id')";
                $connection->query($insertQuery);
            }
        } catch (Exception $e) {
            echo "Hiba történt az email küldése során: " . $mail->ErrorInfo . "<br>";
        }
    }
}

$connection->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Email küldése</title>
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

<h1>Email küldése</h1>

<form action="" method="POST" class="container">
    <label for="recipients">Címzett email címek (vesszővel elválasztva):</label>
    <input type="text" name="recipients" required><br>

    <label for="subject">Tárgy:</label>
    <input type="text" name="subject" required><br>

    <label for="message">Üzenet:</label>
    <textarea name="message" rows="6" style="background-color:orange;" required></textarea><br>

    <button class="button" type="submit">Küldés</button>
    <button class="button" type="button" onclick="parent.location='userevents.php'">Vissza</button>
</form>

</body>
</html>
