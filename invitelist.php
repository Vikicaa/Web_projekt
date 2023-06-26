<?php
session_start();
include("db_config.php");

// Az esemény azonosítója
$event_id = $_SESSION["event_id"];

// Meghívottak és események lekérdezése az adatbázisból az esemény azonosítója alapján
$sql = "SELECT invited.invited_token, invited.invited_mail, events.event_name
        FROM invited
        INNER JOIN events ON invited.event_id = events.event_id
        WHERE invited.event_id = '$event_id'";
$result = $connection->query($sql);

// Törlés logika
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_recipient"])) {
  $invited_token = $_POST["invited_token"];
  $delete_sql = "DELETE FROM invited WHERE invited_token = '$invited_token'";
  $delete_result = $connection->query($delete_sql);
  
  if ($delete_result === TRUE) {
    echo "The invited ($recipient_id) is deleted successfully.";
    header("Location: invitelist.php"); // Átirányítás a frissített listára
    exit();
  } else {
    echo "Something went wrong while deleting invited member: " . $connection->error;
  }
}

$connection->close();
?>


<!DOCTYPE html>
<html>
<head>
  <title>List of invited members</title>
</head>
<body>
  <h1>List of invited memebers</h1>

  <table>
    <thead>
      <tr>
        
        <th>E-mail</th>
        <th>Event</th>
        <th>Operations</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
          
          <td><?php echo $row["invited_mail"]; ?></td>
          <td><?php echo $row["event_name"]; ?></td>
          <td>
            <form action="" method="POST">
              <input type="hidden" name="invited_token" value="<?php echo $row["invited_token"]; ?>">
              <button type="submit" name="delete_recipient">Delete</button>
            </form>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</body>
</html>
