<?php
session_start();

include("db_config.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["token"])) {
    $invite_token = $_GET["token"];

    // Meghívó ellenőrzése az "invited" táblában
    $invite_query = "SELECT * FROM invited WHERE invited_token = '$invite_token'";
    $invite_result = $connection->query($invite_query);

    if ($invite_result->num_rows > 0) {
        $invite_row = $invite_result->fetch_assoc();
        $email = $invite_row["email"];
        $event_id = $invite_row["event_id"];

        // Vendég adatok rögzítése a "guest" táblába
        $response = $_POST["response"];
        $bring_gift = isset($_POST["bring_gift"]) ? 1 : 0;

        $insert_guest_query = "INSERT INTO guests (event_id, bring_gift, invited_token, feedback) VALUES ('$event_id', '$bring_gift', '$invite_token', '$response')";
        $connection->query($insert_guest_query);

        echo "Guest data recorded successfully.";
    } else {
        echo "Invalid invitation token.";
    }

    $connection->close();
}
?>


<form action="" method="POST">
    
    <h2>Answer to the invitation:</h2>
    <input type="radio" name="response" value="yes"> Yes<br>
    <input type="radio" name="response" value="no"> No<br>
    <input type="radio" name="response" value="maybe"> Maybe<br>

    <h2>Gift:</h2>
    <input type="checkbox" name="bring_gift" value="yes"> I want to bring a gift<br>

    <input type="submit" value="Save">
</form>

