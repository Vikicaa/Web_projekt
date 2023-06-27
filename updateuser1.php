<?php
// updateUser.php

if (isset($_POST['user_id']) && isset($_POST['username'])) {
    $userId = $_POST['user_id'];
    $user_name = $_POST['username'];

    // Adatbázis kapcsolat létrehozása
    include("db_config1.php");
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try {
        // Felhasználó frissítése az adatbázisban
        $query = "UPDATE users SET user_name = :user_name WHERE user_id = :user_id";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':user_id', $userId);
        $statement->bindParam(':user_name', $user_name);
        $statement->execute();

        echo "User updated successfully.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Adatbázis kapcsolat bezárása
    $connection = null;
}
?>
