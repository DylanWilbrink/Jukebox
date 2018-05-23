<?php
$user_id = $_GET['id'];

include '../functions/functions.php';
//Check if logged in
if ($_SESSION['logged_in'] == false) {
    header('location: http://localhost/Jukebox/pages/login.php');
}
//Set variable if empty
$submit = isset($_POST['submit']) ? $_POST['submit'] : '';

//Check if form is filled
if ($submit && $_POST['offense'] >= 1 && !empty($_POST['report_comment'])) {

    //Insert report
    $query = $functions->connect()->prepare('INSERT INTO reports (`user_id`, `offense`, `report_comment`, `reported_by`) 
                                                      VALUES (:user_id, :offense, :report_comment, :reported_by)');
    $query->execute(array(
        ':user_id' => $user_id,
        ':offense' => $_POST['offense'],
        ':report_comment' => $_POST['report_comment'],
        ':reported_by' => $_SESSION['user_id']
    ));

    header('location: http://localhost/Jukebox/index.php');
}