<?php
session_start();
?>
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
<button class="button" type="button" onclick="parent.location='userevents.php'">Back</button>

<?php
include("db_config1.php");
if (isset($_SESSION['user_id'])) {
    $currentUserId = $_SESSION['user_id'];
    
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

    try {
        // Adatbázis kapcsolat létrehozása
        $connection = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, $options);

        // Felhasználó eseményeinek lekérdezése az adatbázisból
        $query = "SELECT * FROM events WHERE user_id = :userName";
        $statement = $connection->prepare($query);
        $statement->bindParam(":userName", $currentUserId);
        $statement->execute();
        $events = $statement->fetchAll();

        foreach ($events as $event) {
            $event_id = $event['event_id'];
            $event_name = $event['event_name'];
            $event_date = $event['event_date'];
            $event_location = $event['event_location'];
            $event_price = $event['event_price'];

            $_SESSION['event_id'] = $event_id;
            
            echo '    <tr>';
            echo '        <td>' . $event_name . '</td>';
            echo '        <td>' . $event_date . '</td>';
            echo '        <td>' . $event_location . '</td>';
            echo '        <td>' . $event_price . '</td>';
            echo '        <td>';
            echo '            <button onclick="parent.location=\'comments.php\'">Comments</button>';
            echo '        </td>';
            echo '    </tr>';
        }

        echo '</table>';

        // Adatbázis kapcsolat bezárása
        $connection = null;
    } catch (PDOException $e) {
        echo "Hiba: " . $e->getMessage();
    }

    echo '</body>';
    echo '</html>';
} else {
    echo '<p>Permission denied. Please log in.</p>';
}

?>
</body>
</html>
