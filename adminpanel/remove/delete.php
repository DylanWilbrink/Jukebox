<?php
require_once '../../functions/functions.php';
//Check if logged in and if moderator
if ($_SESSION['logged_in'] == false) {
    header('location: http://localhost/Jukebox/login/login.php');
} else {
    if ($_SESSION['rank'] < 2) {
        header('location: http://localhost/Jukebox/errorpage/index.php');
    }
}

//Select all accepted songs
$query = $functions->connect()->prepare('SELECT * FROM songs WHERE pending = 0');
$query->execute();
$results = $query->fetchAll();

//Delete certain song
foreach ($results as $result) {
    unlink('../../files/' . $result['song']);
    $query = $functions->connect()->prepare('DELETE FROM songs WHERE song_id = :song_id');
    $exec = $query->execute(array(
        ':song_id' => $_GET['id']
    ));

    if ($exec) {
        header('location: index.php');
    }
}

