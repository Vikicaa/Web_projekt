<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$message = '';

if (isset($_POST["send"])) {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'blackandwhitedeveloperstudio@gmail.com'; //Your gmail
    $mail->Password = 'qhkzescyxvyxfqho'; // Your gmail app pw
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('blackandwhitedeveloperstudio@gmail.com'); //your email
    $mail->addAddress($_POST["forgorpwuser_email"]);
    $mail->isHTML(true);

    // Tárgy változóba mentése
    $subject = "Password Recovery";

    // Üzenet változóba mentése
    $message = "https://bw.stud.vts.su.ac.rs/forgotpwsite.php";

    // Tárgy beállítása
    $mail->Subject = $subject;

    // Üzenet beállítása
    $mail->Body = $message;

    if ($mail->send()) {
        $message = "Email sent successfully!";
    } else {
        $message = "Error: Email sending failed.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Rendezvényszervezés</title>
    <link rel="icon" type="image/png" sizes="16x16" href="images/icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">

    <link rel="stylesheet" type="text/css" href="CSS/login.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <script src="JS\script.js"></script>
    <style>
        form {
            height: 40%;
        }

        .error {
            font-family: 'Poppins', sans-serif;
            color: red;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="background">
    <div class="shape"></div>
    <div class="shape"></div>
</div>

<form action="" method="POST">
    <h3>Forgot Password?</h3>

    <label for="forgorpwuser_email">User Email:</label>
    <input type="email" placeholder="Email:" name="forgorpwuser_email" id="forgorpwuser_email" required><br>
    
    <?php if (!empty($message)) { ?>
        <p><?php echo $message; ?></p>
    <?php } ?>
    
    <button type="submit" name="send">Send Email</button>
</form>
</body>
</html>
