<?php
//Check if logged in
if ($_SESSION['logged_in'] == false) {
    header('location: http://localhost/Jukebox/login/login.php');
}
//Select user info
$query = $functions->connect()->prepare('SELECT * FROM users WHERE user_id = :id');
$query->execute(array(
    ':id' => $_GET['id']
));
$results = $query->fetchAll();

//Select songs by user
$query = $functions->connect()->prepare('SELECT * FROM songs WHERE user_id = :user_id ORDER BY song_id LIMIT 10');
$query->execute(array(
    ':user_id' => $_GET['id']
));
$song_results = $query->fetchAll();
$song_count = $query->rowCount();

//Select comments by user
$query = $functions->connect()->prepare('SELECT * FROM comments WHERE user_id = :user_id');
$query->execute(array(
    ':user_id' => $_GET['id']
));
$comment_count = $query->rowCount();