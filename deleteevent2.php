<!DOCTYPE html>
<html>
<head>
    <title>Event Managament</title>
</head>
<body>
    <h1>Event Managament</h1>

    <!-- Események listázása -->
    <h2>Events List</h2>
    <ul>
        <?php
        // Az adatbázis kapcsolódási adataidhoz és az adatbázis sémádhoz kell igazítani.
        include ("db_config.php");
        session_start();
        $user_id = $_SESSION['user_id'];
        // Események lekérdezése az adatbázisból
        $sql = "SELECT * FROM events WHERE user_id = $user_id";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Események listájához hozzáadunk egy linket az esemény módosításához
                echo "<li><a href='deleteevent.php?event_id=" . $row["event_id"] . "'>" . $row["event_name"] . "</a> - " . $row["event_date"] . " - " . $row["event_location"] . " - " . $row["event_price"] ."</li>";
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
