<?php
session_start();
include('db_config.php');
$errors = array();
unset($_SESSION['errors']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Event Organization</title>
    <link rel="icon" type="image/png" sizes="16x16" href="images/icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/icon.png">
    <link rel="stylesheet" type="text/css" href="CSS/comments.css"> 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <script src="JS\script.js"></script>
</head>
<body>
<?php
$currentUserId = $_SESSION['user_id'];
$currentEventId = $_SESSION['event_id'];

if (isset($_SESSION['admin_loggedin']) && $_SESSION['admin_loggedin'] === true) {
    include 'adminheader.php';
} elseif (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $user_name = $_SESSION['user_name'];
    include 'userheader.php';
} else {
    include 'header.php';
}

// Hozzáférés az elküldött hozzászóláshoz
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ellenőrizd, hány kommentet írt már az adott felhasználó
        $commentCountSql = "SELECT COUNT(*) as comment_count FROM comment WHERE user_id = $currentUserId";
        $commentCountResult = $connection->query($commentCountSql);
        $commentCountRow = $commentCountResult->fetch_assoc();
        $commentCount = $commentCountRow['comment_count'];
    
        // Ellenőrizd, hogy az adott felhasználó már írt-e kommentet
        if ($commentCount == 0) {
            $comment = $_POST["comment"];
             
            // Tároljuk el a hozzászólás mező tartalmát
            $_SESSION['last_comment'] = $comment;
    
            // Adatbázisba való beszúrás
            $sql = "INSERT INTO comment (event_id,user_id,comtext) VALUES ($currentEventId,$currentUserId,'$comment')";
            
            if ($connection->query($sql) === TRUE) {
                $errors['general'] =  "The comment has been successfully saved.";
            } else {
                $errors['general'] =  "An error occurred while saving the post: " . $connection->error;
            }
        } else {
            $errors['general'] =  "You have already commented before.";
        }
    
}

$_SESSION['errors'] = $errors;
// Hozzászólások lekérdezése az adatbázisból
$sql = "SELECT comment.comtext, users.user_name
        FROM comment
        INNER JOIN users ON comment.user_id = users.user_id";
$result = $connection->query($sql);
?>

<div class="wrapper">
    <main class="content" style="height: 90vh;">
    
    <div class="head">       
          <button class="headbutton" type="button" onclick="openUserEventsSite()">Back</button>
      </div>
        <div class="commentsite" style="text-align: center;">
            <div class="creatcomment">
                <h1>Create a comment</h1>
                <form action="" method="POST">
                <textarea name="comment" placeholder="Write your comment here, but you have just one chance!!" rows="4" cols="50"><?php echo isset($_SESSION['last_comment']) ? $_SESSION['last_comment'] : ''; ?></textarea>
                    <br>
                    <?php if(isset($_SESSION['errors']['general'])) { echo '<p class="error">'.$_SESSION['errors']['general'].'</p>'; } ?><br>
                    <button type="submit">Submit</button>
                </form>
            </div>
        <div class="readcomment">
            <h1>Comments</h1>
            <?php
            // Hozzászólások listázása
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                $commentText = $row["comtext"];
                $username = $row["user_name"];
                echo "<div class='comment'><strong>$username:</strong> $commentText</div>";
            }
            } else {
            echo "There are no comments.";
            }
            $connection->close();
            ?>
        </div>
    </div>
</main>
</div>
</body>
</html>
