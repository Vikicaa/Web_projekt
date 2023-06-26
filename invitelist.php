<?php
session_start();

include("db_config.php");

if (isset($_SESSION["recipients"])) {
  $recipients = $_SESSION["recipients"];

  // Az eseményhez tartozó meghívottak lekérdezése az adatbázisból
  $query = "SELECT invited_mail FROM invited WHERE invited_mail IN ('$recipients')";
  $result = $connection->query($query);

  if ($result && $result->num_rows > 0) {
    echo "<h1>Meghívottak listája</h1>";
    echo "<table>";
    echo "<tr><th>Név</th><th>Email</th></tr>";

    while ($row = $result->fetch_assoc()) {
      $name = $row['email'];
      $email = $row['email'];

      echo "<tr><td>$name</td><td>$email</td></tr>";
    }

    echo "</table>";
  } else {
    echo "Nincs találat a meghívottakra.";
  }

  // Session adatok törlése
  unset($_SESSION["recipients"]);
} else {
  echo "Nincs elérhető adat a meghívottakra.";
}

$connection->close();
?>
