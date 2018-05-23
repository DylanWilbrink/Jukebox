<?php
include '../functions/functions.php';

if ($_SESSION['logged_in'] == false) {
    header('location: http://localhost/Jukebox/pages/login.php');
}

$song_id = $_GET['song'];
//Get songs and users
$query = $functions->connect()->prepare('SELECT *, u.username, u.profile_picture FROM songs s
                                                  JOIN users u ON s.user_id = u.user_id
                                                  WHERE s.song_id = :song_id');
$query->execute(array(
    ':song_id' => $song_id
));
$results = $query->fetchAll();

//Get comments
$query = $functions->connect()->prepare('SELECT * FROM comments WHERE song_id = :song_id');
$query->execute(array(
    ':song_id' => $song_id
));
$comments = $query->fetchAll();

//Get average rating
$query = $functions->connect()->prepare('SELECT AVG(rating) AS average FROM comments WHERE song_id = :song_id');
$query->execute(array(
    ':song_id' => $song_id
));
$average = $query->fetchAll();

//Check if muted
$query = $functions->connect()->prepare('SELECT punishment FROM users WHERE user_id = :user_id');
$query->execute(array(
    ':user_id' => $_SESSION['user_id']
));
$mute_results = $query->fetchAll();
