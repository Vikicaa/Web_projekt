<?php
session_start();
// Az admin adatok beolvasása a JSON fájlból
$jsonFile = 'admins.json';
$admins = json_decode(file_get_contents($jsonFile), true);
$errors = array();
unset($_SESSION['errors']);
// Adatbázis kapcsolat létrehozása
  include('db_config.php');

// Admin felhasználók hozzáadása az adatbázishoz
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = $_POST["name"];
  $password = $_POST["password"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];

  // Ellenőrizd, hogy az adott e-mail cím már szerepel-e az adatbázisban
  $query = "SELECT * FROM admin WHERE admin_email = '$email'";
  $result = $connection->query($query);
  if ($result->num_rows === 0) {
      // Az admin felhasználó még nem szerepel az adatbázisban, hozzáadás
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Jelszó titkosítása

      $sql = "INSERT INTO admin (admin_name, admin_password, admin_email, admin_phone) VALUES ('$name', '$hashedPassword', '$email', '$phone')";
      if ($connection->query($sql) === TRUE) {
        $errors['general'] =  "Admin user successfully added to database: $name<br>";
      } else {
        $errors['general'] =  "Error adding admin user: " . $conn->error . "<br>";
      }
  } else {
    $errors['email'] =  "The admin user is already in the database with the given e-mail address: $email<br>";
  }
  $_SESSION['errors'] = $errors;
}

// Adatbázis kapcsolat bezárása
$connection->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Add</title>
  <link rel="icon" type="image/png" sizes="16x16" href="images/icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
    <link rel="stylesheet" type="text/css" href="CSS/admins.css"> 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="JS\script.js"></script>
  <style>
    label {
      display: inline-block;
      width: 100px;
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
  <form method="POST" action="" >
    <h1>Admin Add</h1>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br><br>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
    
    <label for="email">E-mail:</label>
    <input type="email" id="email" name="email" required><br><br>
    
    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone" required><br><br>
    <?php if (isset($_SESSION['errors']['email'])) {
        echo '<p class="error">' . $_SESSION['errors']['email'] . '</p>';
    } ?><br>
    <?php if (isset($_SESSION['errors']['general'])) {
        echo '<p class="error">' . $_SESSION['errors']['general'] . '</p>';
    } ?><br>
    <input type="submit" value="Add" class="button">
    <button class="button" type="button" onclick="parent.location='admin_home.php'">Back</button>
  </form>
</body>
</html>
