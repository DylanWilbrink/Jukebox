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

//Select all unsolved reports
$query = $functions->connect()->prepare('SELECT * FROM reports WHERE solved = 0');
$query->execute();
$results = $query->fetchAll();

