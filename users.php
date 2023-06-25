<!DOCTYPE html>
<html>
<head>
    <title>User managament</title>
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
    
    <h1>User managament</h1>

    <?php
    // Ellenőrizze a bejelentkezést és az adminisztrátor jogosultságot
    // Ezt a részt az adott bejelentkezési rendszerhez és jogosultságkezeléshez igazítsa

    $isAdmin = true; // Például, ha az adminisztrátor be van jelentkezve

    if ($isAdmin) {
        // Felhasználók listázása és kezelése
        // Itt megjelenítheti a felhasználók listáját, és lehetőséget adhat a felhasználók módosítására vagy törlésére
        echo '<h2>List of Users</h2>';
        // Adatbázisból lekérdezi a felhasználók adatait és megjeleníti őket egy táblázatban

        echo '<table class="container">';
        echo '    <tr>';
        echo '        <th>Username</th>';
        echo '        <th>Email</th>';
        echo '        <th>Operations</th>';
        echo '    </tr>';

        // Adatbázisból lekérdezi a felhasználók adatait
        // Ezt az adatbázis struktúrájához és az adott rendszerhez igazítsa
        include ("db_config.php");

        $query = "SELECT * FROM users";
        $result = $connection->query($query);

        while ($row = $result->fetch_assoc()) {
            $userid = $row['user_id'];
            $username = $row['user_name'];
            $email = $row['user_email'];

            echo '    <tr>';
            echo '        <td>' . $username . '</td>';
            echo '        <td>' . $email . '</td>';
            echo '        <td>';
            echo '            <a href="profileupdateasadmin.php?id=' . $userid . '">Change</a>';
            echo '            <a href="profiledeleteasadmin.php?id=' . $userid . '">Delete</a>';
            echo '        </td>';
            echo '    </tr>';
        }

        echo '</table>';

        $connection->close();
    } else {
        echo '<p>Do not have permission to visit thos page.</p>';
    }
    ?>
</body>
</html>
