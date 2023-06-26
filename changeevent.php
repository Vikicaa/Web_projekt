<?php
session_start();

// Az adatbázis kapcsolódás konfigurációja
include("db_config.php");

global $connection;
$event_id='';
$event_id = $_GET['event_id'];


// Esemény módosítása
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($event_id)) {
    $event_name = $_POST["event_name"];
    $event_date = $_POST["event_date"];
    $event_location = $_POST["event_location"];
    $event_price = $_POST["event_price"];

   // echo "event_id: " . $event_id . "<br>";
    echo "event_name: " . $event_name . "<br>";
    echo "event_date: " . $event_date . "<br>";
    echo "event_location: " . $event_location . "<br>";
    echo "event_price: " . $event_price . "<br>";

    // Esemény módosítása az adatbázisban
    $sql = "UPDATE events SET event_name='$event_name', event_date='$event_date', event_location='$event_location', event_price='$event_price' WHERE event_id='$event_id'";
    echo "SQL lekérdezés: " . $sql . "<br>"; // Kiírás a debuggoláshoz
    $result = $connection->query($sql);

    if ($result === TRUE) {
        echo "Az esemény sikeresen módosítva lett.";
        $_SESSION["event_id"] = $event_id; // Az event_id visszaállítása a SESSION-ben
        header('Location: changeevent2.php');
        exit(); // Kilépés a script végrehajtásából
    } else {
        echo "Hiba történt az esemény módosítása során: " . $connection->error;
    }
}

// Adatbázis kapcsolat bezárása
$connection->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Rendezvényszervezés</title>
    <link rel="icon" type="image/png" sizes="16x16" href="images/icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
    <link rel="stylesheet" type="text/css" href="CSS/login.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <script src="JS\script.js"></script>
    <style>
        form{
            height:85%;
        }
    </style>
</head>
<body>
<div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
</div>

<h1>Change event details</h1>

<form action="" method="POST" class="container">
    <label for="event_name">Event name:</label>
    <input type="text" name="event_name" required><br>

    <label for="event_date">Event date:</label>
    <input type="date" name="event_date" required><br>

    <label for="event_location">Event location:</label>
    <input type="text" name="event_location" required><br>

    <label for="event_price">Event price:</label>
    <input type="number" name="event_price" required><br>
    
    <input type="hidden" name="event_id" value="<?php echo $_GET['event_id']; ?>">

    <button class="button" type="submit">Change Event Details</button>
    <button class="button" type="button" onclick="openChangeEvent2Site()">Back</button>
</form>

</body>
</html>
