<?php
session_start();

include("db_config.php");

// Az eseményhez tartozó email címek lekérdezése az adatbázisból
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION["event_id"])) {
        $event_id = $_SESSION["event_id"];
        $recipients = $_POST["recipients"]; // Beírt címzett email címek
        $recipient_emails = explode(",", $recipients); // Címzett email címek tömbbe szétválasztása

        foreach ($recipient_emails as $email) {
            $email = trim($email); // Felesleges szóközök eltávolítása

            // Ellenőrizzük, hogy az email már szerepel-e a küldött meghívók között
            $checkQuery = "SELECT * FROM invited WHERE invited_mail = '$email' AND event_id = $event_id";
            $checkResult = $connection->query($checkQuery);

            if ($checkResult && $checkResult->num_rows == 0) {
                // Az email még nem szerepel a küldött meghívók között, így elküldjük
                $subject = $_POST["subject"];
                $message = $_POST["message"];

                // Email küldése
                $headers = "From: nev@example.com"; // Az email küldő neve és címe
                if (mail($email, $subject, $message, $headers)) {
                    echo "Sikeresen elküldve: " . $email . "<br>";

                    // A küldött meghívó rögzítése a "invited" táblában
                    $insertQuery = "INSERT INTO invited (invited_mail, event_id) VALUES ('$email', $event_id)";
                    $connection->query($insertQuery);
                } else {
                    echo "Hiba történt az email küldése során: " . $email . "<br>";
                }
            } else {
                echo "Az email már korábban elküldve: " . $email . "<br>";
            }
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
    <textarea name="message" rows="6" required></textarea><br>

    <button class="button" type="submit">Küldés</button>
    <button class="button" type="button" onclick="parent.location='userevents.php'">Vissza</button>
</form>

</body>
</html>
