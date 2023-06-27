<?php
session_start();


include("db_config.php");

$event_idforinv = $_SESSION['event_id'];
echo $event_idforinv;

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

        $insert_guest_query = "INSERT INTO guests (event_id, gift_id, invited_token, feedback) VALUES ('$event_id', '$bring_gift', '$invited_token', '$response')";
        $connection->query($insert_guest_query);

        echo "Guest data recorded successfully.";

    } else {
        echo "Invalid invitation token.";
    }

    $connection->close();
}
?>


<form action="" method="POST">

    <label for="invited_email">Your email:</label>
    <input type="text" name="invited_email" required><br>

    <h2>Answer to the invitation:</h2>
    <input type="radio" name="response" value="yes"> Yes<br>
    <input type="radio" name="response" value="no"> No<br>
    <input type="radio" name="response" value="maybe"> Maybe<br>

    <h2>Gift:</h2>
    <input type="checkbox" name="bring_gift" value="yes"> I want to bring a gift<br>

    <input type="submit" value="Save">
</form>

