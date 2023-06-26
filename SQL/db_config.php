<?php

    define("HOST","localhost");
    define("USER","root");
    define("PASSWORD","");
    define("DATABASE","events");

    $connection = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    mysqli_query($connection,"SET NAMES utf8") or die (mysqli_error($connection));
    mysqli_query($connection,"SET CHARACTER SET utf8") or die (mysqli_error($connection));
    mysqli_query($connection,"SET COLLATION_CONNECTION='utf8_general_ci'") or die (mysqli_error($connection));

    ?>

