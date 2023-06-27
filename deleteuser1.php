<?php
// deleteUser.php

if (isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];

    // Adatbázis kapcsolat létrehozása
    include("db_config1.php");
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try {
        // Felhasználó törlése az adatbázisból
        $query = "DELETE FROM users WHERE user_id = :user_id";
        $statement = $pdo->prepare($query);
        $statement->bindParam(':user_id', $userId);
        $statement->execute();

        echo "User deleted successfully.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Adatbázis kapcsolat bezárása
    $connection = null;
}
?>
