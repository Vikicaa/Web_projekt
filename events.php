<!DOCTYPE html>
<html>
<head>
    <title>Event Management</title>
    <link rel="icon" type="image/png" sizes="16x16" href="images/icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
    <link rel="stylesheet" type="text/css" href="CSS/users.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <script src="JS/script.js"></script>
</head>
<body>

<div class="background">
    <div class="shape"></div>
    <div class="shape"></div>
    <div class="shape"></div>
</div>

<h1>Event Management</h1>
<button class="button" type="button" onclick="parent.location='admin_home.php'">Back</button>

<?php
// Ellenőrizze a bejelentkezést és az adminisztrátor jogosultságot
// Ezt a részt az adott bejelentkezési rendszerhez és jogosultságkezeléshez igazítsa

$isAdmin = true; // Például, ha az adminisztrátor be van jelentkezve

if ($isAdmin) {
    // Felhasználók listázása és kezelése
    // Itt megjelenítheti a felhasználók listáját, és lehetőséget adhat a felhasználók módosítására vagy törlésére
    echo '<h2>List of Events</h2>';
    // Adatbázisból lekérdezi az események adatait és megjeleníti őket egy táblázatban

    echo '<table class="container">';
    echo '    <tr>';
    echo '        <th>Event Name</th>';
    echo '        <th>Date</th>';
    echo '        <th>Location</th>';
    echo '        <th>Price</th>';
    echo '        <th>Operations</th>';
    echo '    </tr>';

    // Adatbázisból lekérdezi az események adatait
    // Ezt az adatbázis struktúrájához és az adott rendszerhez igazítsa

    include("db_config1.php");

    try {
        // Adatbázis kapcsolat létrehozása
        $connection = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, $options);

        // Események lekérdezése az adatbázisból
        $query = "SELECT * FROM events";
        $statement = $connection->query($query);
        $events = $statement->fetchAll();

        foreach ($events as $event) {
            $event_id = $event['event_id'];
            $event_name = $event['event_name'];
            $event_date = $event['event_date'];
            $event_location = $event['event_location'];
            $event_price = $event['event_price'];

            echo '    <tr>';
            echo '        <td>' . $event_name . '</td>';
            echo '        <td>' . $event_date . '</td>';
            echo '        <td>' . $event_location . '</td>';
            echo '        <td>' . $event_price . '</td>';
            echo '        <td>';
            echo '            <button onclick="deleteEvent(' . $event_id . ')">Delete</button>';
            echo '            <button onclick="updateEvent(' . $event_id . ')">Change</button>';
            echo '        </td>';
            echo '    </tr>';
        }

        echo '</table>';

        // Adatbázis kapcsolat bezárása
        $connection = null;
    } catch (PDOException $e) {
        echo "Hiba: " . $e->getMessage();
    }
} else {
    echo '<p>Do not have permission to visit this page.</p>';
}
?>
</body>
</html>
