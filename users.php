<!DOCTYPE html>
<html>
<head>
    <title>Felhasználókezelés</title>
</head>
<body>
    <h1>Felhasználókezelés</h1>

    <?php
    // Ellenőrizze a bejelentkezést és az adminisztrátor jogosultságot
    // Ezt a részt az adott bejelentkezési rendszerhez és jogosultságkezeléshez igazítsa

    $isAdmin = true; // Például, ha az adminisztrátor be van jelentkezve

    if ($isAdmin) {
        // Felhasználók listázása és kezelése
        // Itt megjelenítheti a felhasználók listáját, és lehetőséget adhat a felhasználók módosítására vagy törlésére
        echo '<h2>Felhasználók listája</h2>';
        // Adatbázisból lekérdezi a felhasználók adatait és megjeleníti őket egy táblázatban

        echo '<table>';
        echo '    <tr>';
        echo '        <th>Felhasználónév</th>';
        echo '        <th>Email</th>';
        echo '        <th>Műveletek</th>';
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
            echo '            <a href="profil_modositas.php?id=' . $userid . '">Módosítás</a>';
            echo '            <a href="felhasznalo_torlese.php?id=' . $userid . '">Törlés</a>';
            echo '        </td>';
            echo '    </tr>';
        }

        echo '</table>';

        $connection->close();
    } else {
        echo '<p>Nincs megfelelő jogosultság az oldal megtekintéséhez.</p>';
    }
    ?>
</body>
</html>
