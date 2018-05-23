<?php
require_once '../functions/functions.php';
$user_id = $_GET['id'];

//Don't punish
if ($_POST['punishment'] == 0) {
    $query = $functions->connect()->prepare('UPDATE reports
                                                          SET solved = 1
                                                          WHERE user_id = :user_id');
    $exec = $query->execute(array(
        ':user_id' => $user_id
    ));

    if ($exec) {
        echo 'Succesful';
    }

    //Mute user
} elseif ($_POST['punishment'] == 1) {
    $query = $functions->connect()->prepare('UPDATE users u, reports r
                                                  SET u.punishment = 1,
                                                  r.solved = 1
                                                  WHERE u.user_id = :user_id
                                                  AND r.user_id = :user_id');
    $exec = $query->execute(array(
        ':user_id' => $user_id
    ));

    if ($exec) {
        echo 'Succesfully muted';
    }

    //Ban user
} elseif ($_POST['punishment'] == 2) {
    $query = $functions->connect()->prepare('UPDATE users u, reports r
                                                  SET u.punishment = 2,
                                                  r.solved = 1
                                                  WHERE u.user_id = :user_id
                                                  AND r.user_id = :user_id');
    $exec = $query->execute(array(
        ':user_id' => $user_id
    ));

    if ($exec) {
        echo 'Succesfully banned';
    }

    //Terminate user
} elseif ($_POST['punishment'] == 3) {
    $query = $functions->connect()->prepare('UPDATE users u, reports r
                                                  SET u.punishment = 3,
                                                  r.solved = 1
                                                  WHERE u.user_id = :user_id
                                                  AND r.user_id = :user_id');
    $exec = $query->execute(array(
        ':user_id' => $user_id
    ));

    if ($exec) {
        echo 'Succesfully terminated';
    }
}
header('location: ../pages/reported.php');