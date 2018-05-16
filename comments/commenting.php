<?php
include '../functions/functions.php';
//Get song
$song_id = $_GET['id'];

//Check if muted
$query = $functions->connect()->prepare('SELECT punishment FROM users WHERE user_id = :user_id');
$query->execute(array(
    ':user_id' => $_SESSION['user_id']
));
$mute_results = $query->fetchAll();

foreach ($mute_results as $mute_result) {

//If muted, can't comment
    if ($mute_result['punishment'] == 1) {
        echo 'User muted';
        //Else post comment
    } else {
        if (isset($_POST['submit'])) {
            if (!empty($_POST['rating']) && !empty($_POST['comment'])) {
                $query = $functions->connect()->prepare('INSERT INTO comments (rating, comment, user_id, song_id) VALUES (:rating, :comment, :user_id, :song_id)');

                $query->execute(array(
                    ':rating' => $_POST['rating'],
                    ':comment' => $_POST['comment'],
                    ':user_id' => $_SESSION['user_id'],
                    ':song_id' => $song_id
                ));
                $_SESSION['commentError'] = '';
            } else {
                $_SESSION['commentError'] = 'Please fill in the entire form';
            }
        } else {
            $_SESSION['commentError'] = 'Nothing happened...';
        }
    }
}

header('location: ../song/song.php?song=' . $_GET['id']);