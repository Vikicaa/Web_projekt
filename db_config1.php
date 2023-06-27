<?php
/*
    define("HOST","localhost");
    define("USER","bw");
    define("PASSWORD","4qEA1dED43ObX44");
    define("DATABASE","bw");

    $connection = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    mysqli_query($connection,"SET NAMES utf8") or die (mysqli_error($connection));
    mysqli_query($connection,"SET CHARACTER SET utf8") or die (mysqli_error($connection));
    mysqli_query($connection,"SET COLLATION_CONNECTION='utf8_general_ci'") or die (mysqli_error($connection));

define("HOST", "localhost");
define("USER", "bw");
define("PASSWORD", "4qEA1dED43ObX44");
define("DATABASE", "bw");
*/
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

