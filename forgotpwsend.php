<?php
session_start();


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_POST["send"])){
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth=true;
    $mail->Username='blackandwhitedeveloperstudio@gmail.com'; //Your gmail
    $mail->Password='qhkzescyxvyxfqho'; // Your gmail app pw
    $mail->SMTPSecure='ssl';
    $mail->Port=465;

    $mail->setFrom('blackandwhitedeveloperstudio@gmail.com'); //you email


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

    $mail->send();

    echo
    "
    <script>
    alert('Sent Successfully');
    document.location.href='index.php';
    </script>
    ";
}

?>