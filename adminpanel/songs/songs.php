<?php
include '../../functions/functions.php';

//Check if logged in and if moderator
if ($_SESSION['logged_in'] == false) {
    header('location: http://localhost/Jukebox/login/login.php');
} else {
    if ($_SESSION['rank'] < 2) {
        header('location: http://localhost/Jukebox/errorpage/index.php');
    }

    //Select all pending songs
$query = $functions->connect()->prepare('SELECT * FROM songs WHERE pending = 1');
$query->execute();
$results = $query->fetchAll();
}