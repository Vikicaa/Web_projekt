<?php

$host = 'localhost'; // adatbázis szerver elérési útja
$username = 'root'; // adatbázis felhasználónév
$password = ''; // adatbázis jelszó
$dbname = 'events'; // adatbázis neve

// További beállítások (opcionális)
$options = array(
    PDO::ATTR_EMULATE_PREPARES => false, // ne emulálja a prepared statementeket
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // hibaüzenetek kivételként kezelése
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // alapértelmezett fetch mód beállítása asszociatív tömbre
);

    ?>

