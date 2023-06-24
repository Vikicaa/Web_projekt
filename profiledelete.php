<?php

include ("db_config.php");

// Fiók törlése gomb lenyomásának ellenőrzése
if (isset($_POST['delete_account'])) {
    $query = "DELETE FROM users WHERE user_id = '$loggedInEmail'";
    $connection->query($query);

    echo "Profile delete is succesfull!";

    
}

$connection->close();
?>