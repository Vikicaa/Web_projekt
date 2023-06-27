<?php
session_start();

include("db_config.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Az esemény azonosítója
$user_id = $_SESSION["user_id"];

// Meghívottak és események lekérdezése az adatbázisból az esemény azonosítója alapján
$sql = "SELECT invited.invited_token, invited.invited_mail, guests.feedback, events.event_name
        FROM invited
        INNER JOIN events ON invited.event_id = events.event_id
        LEFT JOIN guests ON invited.invited_token = guests.invited_token
        WHERE invited.user_id = '$user_id'";
$result = $connection->query($sql);

// Törlés logika
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_recipient"])) {
  $invited_token = $_POST["invited_token"];

  // Az érintett e-mail címének lekérdezése
  $email_sql = "SELECT invited_mail, events.event_name
                FROM invited
                INNER JOIN events ON invited.event_id = events.event_id
                WHERE invited_token = '$invited_token'";
  $email_result = $connection->query($email_sql);
  $email_row = $email_result->fetch_assoc();
  $invited_mail = $email_row["invited_mail"];
  $event_name = $email_row["event_name"];

  // Meghívott törlése az adatbázisból
  $delete_sql = "DELETE FROM invited WHERE invited_token = '$invited_token'";
  $delete_result = $connection->query($delete_sql);

  if ($delete_result === TRUE) {

    // E-mail küldése az érintettnek
    $mail = new PHPMailer(true);

    try {
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com'; // Állítsd be a SMTP szerver adatait
      $mail->SMTPAuth = true;
      $mail->Username = 'blackandwhitedeveloperstudio@gmail.com'; // Állítsd be a saját e-mail címedet és jelszavadat
      $mail->Password = 'qhkzescyxvyxfqho';
      $mail->SMTPSecure = 'ssl';
      $mail->Port = 465;

      $mail->setFrom('blackandwhitedeveloperstudio@gmail.com');
      $mail->isHTML(true);

      $mail->addAddress($invited_mail);
      $mail->Subject = 'Invitation Cancellation';
      $mail->Body = "Dear recipient, your invitation for the event \"$event_name\" has been canceled.";
      $mail->send();

      echo "The invited member ($invited_mail) has been deleted successfully.";
      header("Location: invitelist.php"); // Átirányítás a frissített listára
      exit();
    } catch (Exception $e) {
      $errors['user_email'] = "Something went wrong while sending email: " . $mail->ErrorInfo . "<br>";
    }
  } else {
    $errors['user_email'] = "Something went wrong while deleting the invited member: " . $connection->error;
  }
}
function getFeedbackText($feedback) {
  if ($feedback == 1) {
    return "Yes";
  } elseif ($feedback == 2) {
    return "No";
  } elseif ($feedback == 3) {
    return "Maybe";
  } else {
    return "Unknown";
  }
}

$connection->close();
?>

<!DOCTYPE html>
<html>

<head>
  <title>List of invited members</title>
  <link rel="icon" type="image/png" sizes="16x16" href="images/icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
  <link rel="stylesheet" type="text/css" href="CSS/invitelist.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
  <script src="JS\script.js"></script>
</head>

<body>

  <h1>List of invited members</h1>
  <button class="buttonhead" type="button" onclick="parent.location='userevents.php'">Back</button>

  <table>
    <thead>
      <tr>
        <th>Invited Members E-mail</th>
        <th>Event name</th>
        <th>Feedback</th>
        <th>Operations</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
          <td><?php echo $row["invited_mail"]; ?></td>
          <td><?php echo $row["event_name"]; ?></td>
          <td><?php echo getFeedbackText($row["feedback"]); ?></td>
          <td>
            <form action="" method="POST">
              <input type="hidden" name="invited_token" value="<?php echo $row["invited_token"]; ?>">
              <button type="submit" name="delete_recipient" class="button">Delete</button>
            </form>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</body>

</html>
