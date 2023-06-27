<!DOCTYPE html>
<html>
<head>
  <title>Admin User Add</title>
  <style>
    label {
      display: inline-block;
      width: 100px;
    }
  </style>
</head>
<body>
  <h2>Admin User Add</h2>
  
  <form method="POST" action="">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br><br>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
    
    <label for="email">E-mail:</label>
    <input type="email" id="email" name="email" required><br><br>
    
    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone" required><br><br>
    
    <input type="submit" value="Add">
  </form>

  <?php

  // Az admin adatok beolvasása a JSON fájlból
  $jsonFile = 'admins.json';
  $admins = json_decode(file_get_contents($jsonFile), true);

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
            echo "Admin user successfully added to database: $name<br>";
        } else {
            echo "Error adding admin user: " . $conn->error . "<br>";
        }
    } else {
        echo "The admin user is already in the database with the given e-mail address: $email<br>";
    }
  }

  // Adatbázis kapcsolat bezárása
  $connection->close();
  ?>

</body>
</html>
