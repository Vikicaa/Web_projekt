<!DOCTYPE html>
<html>
<head>
    <title>Event managament</title>
    <link rel="icon" type="image/png" sizes="16x16" href="images/icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
  <link rel="stylesheet" type="text/css" href="CSS/profil.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">

</head>
<body>

<div class="background">
        <div class="shape"></div>
		<div class="shape"></div>
        <div class="shape"></div>
    </div>
    
    <h1>Event managament</h1>

    <?php
    // Ellenőrizze a bejelentkezést és az adminisztrátor jogosultságot
    // Ezt a részt az adott bejelentkezési rendszerhez és jogosultságkezeléshez igazítsa

    $isAdmin = true; // Például, ha az adminisztrátor be van jelentkezve

    if ($isAdmin) {
        // Felhasználók listázása és kezelése
        // Itt megjelenítheti a felhasználók listáját, és lehetőséget adhat a felhasználók módosítására vagy törlésére
        echo '<h2>List of Events</h2>';
        // Adatbázisból lekérdezi a felhasználók adatait és megjeleníti őket egy táblázatban

        echo '<table class="container">';
        echo '    <tr>';
        echo '        <th>Event Name</th>';
        echo '        <th>Date</th>';
        echo '        <th>Operations</th>';
        echo '    </tr>';

        // Adatbázisból lekérdezi a felhasználók adatait
        // Ezt az adatbázis struktúrájához és az adott rendszerhez igazítsa
        include ("db_config.php");

        $query = "SELECT * FROM events";
        $result = $connection->query($query);

        while ($row = $result->fetch_assoc()) {
            $event_id = $row['event_id'];
            $event_name = $row['event_name'];
            $event_date = $row['event_date'];

            echo '    <tr>';
            echo '        <td>' . $event_name . '</td>';
            echo '        <td>' . $event_date . '</td>';
            echo '        <td>';
            echo '            <a href="eventupdateasadmin.php?id=' . $event_id . '">Change</a>';
            echo '            <a href="eventedeleteasadmin.php?id=' . $event_id . '">Delete</a>';
            echo '        </td>';
            echo '    </tr>';
        }

        echo '</table>';
        $_SESSION['event_id'] = $event_id;

        $connection->close();
    } else {
        echo '<p>Do not have permission to visit thos page.</p>';
    }
    ?>
</body>
</html>