<?php
include '../../functions/functions.php';

//Check if logged in and if moderator
if ($_SESSION['logged_in'] == false) {
    header('location: http://localhost/Jukebox/login/login.php');
} else {
    if ($_SESSION['rank'] < 2) {
        header('location: http://localhost/Jukebox/errorpage/index.php');
    }
}

//Get song id
if (empty($_GET['id'])) {
    $song_id = '';
} else {
    $song_id = $_GET['id'];
}

//Get song you want to accept/deny
$query = $functions->connect()->prepare('SELECT * FROM songs WHERE song_id = :song_id');
$query->execute(array(
    ':song_id' => $song_id
));

$results = $query->fetchAll();

//Check if accepted then change value
if (isset($_POST['accept'])) {
    $query = $functions->connect()->prepare('UPDATE songs
                                             SET pending = 0
                                             WHERE song_id = :song_id');
    $exec = $query->execute(array(
        ':song_id' => $song_id
    ));
    if ($exec) {
        header('location: ../songs');
    }
}

//Check if denied then change value
if (isset($_POST['deny'])) {
    $select_query = $functions->connect()->prepare('SELECT * FROM songs WHERE song_id = :song_id');
    $select_query->execute(array(
        ':song_id' => $song_id
    ));
    $results = $select_query->fetchAll();

    //Delete file if denied
    foreach ($results as $result) {
        unlink('../../files/' . $result['song']);
        $query = $functions->connect()->prepare('DELETE FROM songs
                                                      WHERE song_id = :song_id');
        $exec = $query->execute(array(
            ':song_id' => $song_id
        ));
        if ($exec) {
            header('location: ../songs');
        }
    }
}
