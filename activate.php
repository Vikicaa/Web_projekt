<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

session_start();

$errors = array();
ini_set('display_errors', 'On');
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['activation_key'])) {
    include("db_config1.php");

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $activationKey = $_GET['activation_key'];

        // Ellenőrizze, hogy a megadott aktiválási kulcs létezik-e az adatbázisban
        $stmt = $pdo->prepare("SELECT * FROM users WHERE activation_key = :activation_key");
        $stmt->bindParam(":activation_key", $activationKey);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Aktiválja a felhasználó regisztrációját
            $stmt = $pdo->prepare("UPDATE users SET activated = 1 WHERE activation_key = :activation_key");
            $stmt->bindParam(":activation_key", $activationKey);
            $stmt->execute();

            $_SESSION['activation_message'] = "Account activated successfully. You can now log in.";
            header('Location: login.php');
            exit();
        } else {
            $errors['general'] = "Invalid activation key.";
            $_SESSION['errors'] = $errors;
            header('Location: registration.php');
            exit();
        }

        $pdo = null;
    } catch (PDOException $e) {
        $errors['general'] = "Something went wrong during activation: " . $e->getMessage();
        $_SESSION['errors'] = $errors;
        header('Location: registration.php');
        exit();
    } catch (Exception $e) {
        $errors['general'] = "Something went wrong: " . $e->getMessage();
        $_SESSION['errors'] = $errors;
        header('Location: registration.php');
        exit();
    }
} else {
    header('Location: registration.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Account Activation</title>
    <!-- Az oldal stíluslapja -->
</head>
<body>
    <h1>Account Activation</h1>
    <p>Waiting for activation...</p>
</body>
</html>
