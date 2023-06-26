<!DOCTYPE html>
<html>
<head>
    <title>Event Management</title>
    <link rel="icon" type="image/png" sizes="16x16" href="images/icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
  <link rel="stylesheet" type="text/css" href="CSS/invitelist.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
  <script src="JS\script.js"></script>
</head>
<body>
    <h1>Event Management</h1>

    <!-- Események listázása -->
    <h2>Events List</h2>
    <button class="buttonhead" type="button" onclick="parent.location='userevents.php'">Back</button>
    <table>
        <tr>
            <th>Event Name</th>
            <th>Date</th>
            <th>Location</th>
            <th>Price</th>
        </tr>
        <?php
        // Az adatbázis kapcsolódási adataidhoz és az adatbázis sémádhoz kell igazítani.
        include("db_config.php");
        session_start();
        $user_id = $_SESSION['user_id'];
        // Események lekérdezése az adatbázisból
        $sql = "SELECT * FROM events WHERE user_id = $user_id";
        $result = $connection->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Események listájához hozzáadunk egy linket az esemény módosításához
                echo "<tr>";
                echo "<td><a href='deleteevent.php?event_id=" . $row["event_id"] . "'>" . $row["event_name"] . "</a></td>";
                echo "<td>" . $row["event_date"] . "</td>";
                echo "<td>" . $row["event_location"] . "</td>";
                echo "<td>" . $row["event_price"] . " din</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>There are no events.</td></tr>";
        }

        // Adatbázis kapcsolat bezárása
        $connection->close();
        ?>
    </table>
</body>
</html>
