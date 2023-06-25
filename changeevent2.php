<!DOCTYPE html>
<html>
<head>
    <title>Események kezelése</title>
</head>
<body>
    <h1>Események kezelése</h1>

    <!-- Események listázása -->
    <h2>Események listája</h2>
    <ul>
        <?php
        // Az adatbázis kapcsolódási adataidhoz és az adatbázis sémádhoz kell igazítani.
        include ("db_config.php");

        // Események lekérdezése az adatbázisból
        $sql = "SELECT * FROM events";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Események listájához hozzáadunk egy linket az esemény módosításához
                echo "<li><a href='changeevent.php?event_id=" . $row["event_id"] . "'>" . $row["event_name"] . "</a> - " . $row["event_date"] . " - " . $row["event_location"] . " - " . $row["event_price"] ."</li>";
            }
        } else {
            echo "<li>There are no events.</li>";
        }

        // Adatbázis kapcsolat bezárása
        $connection->close();
        ?>
    </ul>
</body>
</html>
