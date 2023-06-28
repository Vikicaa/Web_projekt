<?php
session_start();

$errors = array();
unset($_SESSION['errors']);
include("db_config.php");

$event_idforinv = $_SESSION['event_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["invited_email"];
    // Meghívó ellenőrzése az "invited" táblában
    $invite_query = "SELECT * FROM invited WHERE invited_mail = '$email' AND event_id = '$event_idforinv'";
    $invite_result = $connection->query($invite_query);
    if ($invite_result->num_rows > 0) {
        $row = $invite_result->fetch_assoc();
		$event_id=$row['event_id'];
		$invited_token=$row['invited_token'];

        // Vendég adatok rögzítése a "guests" táblába
        $response = $_POST["response"];
        $bring_gift = isset($_POST["bring_gift"]) ? 1 : 0;

        $insert_guest_query = "INSERT INTO guests (event_id, invited_token, bring_gift,feedback) VALUES ('$event_id', '$invited_token','$bring_gift', '$response')";
        $connection->query($insert_guest_query);

        $errors['general'] = "Your answare is recorded successfully.";
        header('Location: user_home.php');
    } else {
        $errors['general'] = "Invalid invitation token.";
    }

    $connection->close();
} else {
    unset($_SESSION['errors']);
}
// Store the errors in the session
$_SESSION['errors'] = $errors;
?>
<!DOCTYPE html>
<html>

<head>
  <title>List of invited members</title>
  <link rel="icon" type="image/png" sizes="16x16" href="images/icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
  <link rel="stylesheet" type="text/css" href="CSS/invitation.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
  <script src="JS\script.js"></script>
  <style>

  .error {
  font-family: 'Poppins',sans-serif;
  color: red;
  letter-spacing: 0.5px;
  outline: none;
  border: none;
  font-weight: bold;
}
</style>
</head>

<body>

<form action="" method="POST">

    <label for="invited_email">Your email:</label>
    <input type="text" name="invited_email" required><br>

    <h2>Answer to the invitation:</h2>
    <div class="response">
    <input type="radio" name="response" value="1"> Yes<br>
    <input type="radio" name="response" value="2"> No<br>
    <input type="radio" name="response" value="3"> Maybe<br>
    </div>
    <h2>Gift:</h2>
    <input type="checkbox" name="bring_gift" value="yes"> I want to bring a gift<br>
    <?php if(isset($_SESSION['errors']['general'])) { echo '<p class="error">'.$_SESSION['errors']['general'].'</p>'; } ?><br>
    <input type="submit" value="Save">
</form>

</body>

</html>
