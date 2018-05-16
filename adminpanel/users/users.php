<?php
include '../../functions/functions.php';

if ($_SESSION['logged_in'] == false) {
    header('location: http://localhost/Jukebox/login/login.php');
} else {
    if ($_SESSION['rank'] < 2) {
        header('location: http://localhost/Jukebox/errorpage/index.php');
    }
}
$limit = 30;
//Select all users
$query = $functions->connect()->prepare('SELECT * FROM users');
$query->execute();

//Count users $ get necessary amount of pages
$total_results = $query->rowCount();
$total_pages = ceil($total_results / $limit);

//Get current page
if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$starting_limit = ($page - 1) * $limit;

$search = isset($_POST['search']) ? $_POST['search'] : '';
//If searching use this query
if (isset($_POST['submit'])) {

    //If search is filled
    if (!empty($_POST['search'])) {
        $query = $functions->connect()->prepare("SELECT * FROM users
                                                      WHERE username LIKE :search OR email LIKE :search
                                                      ORDER BY user_id DESC
                                                      LIMIT $starting_limit, $limit");
        $query->execute(array(
            ':search' => $search
        ));
        $users = $query->fetchAll();

        //If search is not filled
    } else {
        $query = $functions->connect()->prepare("SELECT * FROM users
                                                      ORDER BY user_id DESC
                                                      LIMIT $starting_limit, $limit");
        $query->execute();
        $users = $query->fetchAll();
    }
    //If not searching
} else {
    $query = $functions->connect()->prepare("SELECT * FROM users
                                                      ORDER BY user_id DESC
                                                      LIMIT $starting_limit, $limit");
    $query->execute();
    $users = $query->fetchAll();
}

$_SESSION['user_search'] = $search;