<?php
include '../functions/functions.php';

//Check if logged in
if ($_SESSION['logged_in'] == false) {
    header('location: http://localhost/Jukebox/pages/login.php');
}

//Select genres
$genre_query = $functions->connect()->prepare('SELECT * FROM genres');
$genre_query->execute();
$genres = $genre_query->fetchAll();

//Select all pages
$limit = 20;

$query = $functions->connect()->prepare('SELECT * FROM songs WHERE pending = 0');
$query->execute();
$results = $query->fetchAll();

$total_results = $query->rowCount();
$total_pages = ceil($total_results / $limit);

//Get current page
if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$starting_limit = ($page - 1) * $limit;

//Set variable if not set
$sorting = 0;
$sorting = isset($_POST['sort_by']) ? $_POST['sort_by'] : '';

$search = '';
$search = isset($_POST['search']) ? $_POST['search'] : '';

if (!empty($_POST['search'])) {
    //Check sorted option
    switch ($sorting) {

        //Default if searching
        default:
            $show = $functions->connect()->prepare("SELECT * FROM songs s
                                                             WHERE s.pending = 0
                                                             ORDER BY s.song_id DESC 
                                                             LIMIT $starting_limit, $limit");
            $show->execute();
            $shows = $show->fetchAll();
            $show_count = $show->rowCount();
            break;
            //If searching and sorting by newest
        case 0:
            $show = $functions->connect()->prepare("SELECT * FROM songs s
                                                             JOIN users u ON u.user_id = s.user_id
                                                             WHERE s.title LIKE :search OR u.username LIKE :search
                                                             AND s.pending = 0 
                                                             ORDER BY s.song_id DESC 
                                                             LIMIT $starting_limit, $limit");
            $show->execute(array(
                ':search' => $search
            ));
            $shows = $show->fetchAll();
            $show_count = $show->rowCount();
            break;
            //If searching and sorting by oldest
        case 1:
            $show = $functions->connect()->prepare("SELECT * FROM songs s
                                                             JOIN users u ON u.user_id = s.user_id 
                                                             WHERE s.title LIKE :search OR u.username LIKE :search
                                                             AND s.pending = 0
                                                             ORDER BY s.song_id ASC 
                                                             LIMIT $starting_limit, $limit");
            $show->execute(array(
                ':search' => $search
            ));
            $shows = $show->fetchAll();
            $show_count = $show->rowCount();
            break;
            //If searching and sorting by highest rating
        case 2:
            $show = $functions->connect()->prepare("SELECT *, AVG(c.rating) AS average FROM songs s
                                                             JOIN comments c ON c.song_id = s.song_id
                                                             JOIN users u ON u.user_id = s.user_id
                                                             WHERE s.title LIKE :search OR u.username LIKE :search
                                                             AND s.pending = 0 
                                                             GROUP BY c.song_id
                                                             ORDER BY average ASC 
                                                             LIMIT $starting_limit, $limit");
            $show->execute(array(
                ':search' => $search
            ));
            $shows = $show->fetchAll();
            $show_count = $show->rowCount();
            break;
            //If searching and sorting by lowest rating
        case 3:
            $show = $functions->connect()->prepare("SELECT *, AVG(c.rating) AS average FROM songs s
                                                             JOIN comments c ON c.song_id = s.song_id
                                                             JOIN users u ON u.user_id = s.user_id
                                                             WHERE s.title LIKE :search OR u.username LIKE :search
                                                             AND s.pending = 0 
                                                             GROUP BY c.song_id
                                                             ORDER BY average DESC 
                                                             LIMIT $starting_limit, $limit");
            $show->execute(array(
                ':search' => $search
            ));
            $shows = $show->fetchAll();
            $show_count = $show->rowCount();
            break;
    }
} else {
    switch ($sorting) {
//Default if not searching
        default:
            $show = $functions->connect()->prepare("SELECT * FROM songs 
                                                             WHERE pending = 0
                                                             ORDER BY song_id DESC 
                                                             LIMIT $starting_limit, $limit");
            $show->execute();
            $shows = $show->fetchAll();
            $show_count = $show->rowCount();
            break;
            //If not searching and sorting by newest
        case 0:
            $show = $functions->connect()->prepare("SELECT * FROM songs 
                                                             WHERE pending = 0
                                                             ORDER BY song_id DESC 
                                                             LIMIT $starting_limit, $limit");
            $show->execute();
            $shows = $show->fetchAll();
            $show_count = $show->rowCount();
            break;
            //If not searching and sorting by oldest
        case 1:
            $show = $functions->connect()->prepare("SELECT * FROM songs 
                                                             WHERE pending = 0
                                                             ORDER BY song_id ASC 
                                                             LIMIT $starting_limit, $limit");
            $show->execute();
            $shows = $show->fetchAll();
            $show_count = $show->rowCount();
            break;
            //If not searching and sorting by highest rating
        case 2:
            $show = $functions->connect()->prepare("SELECT *, AVG(c.rating) AS average FROM songs s
                                                             JOIN comments c ON c.song_id = s.song_id
                                                             WHERE s.pending = 0
                                                             GROUP BY c.song_id
                                                             ORDER BY average ASC 
                                                             LIMIT $starting_limit, $limit");
            $show->execute();
            $shows = $show->fetchAll();
            $show_count = $show->rowCount();
            break;
            //If not searching and sorting by lowest rating
        case 3:
            $show = $functions->connect()->prepare("SELECT *, AVG(c.rating) AS average FROM songs s
                                                             JOIN comments c ON c.song_id = s.song_id
                                                             WHERE s.pending = 0
                                                             GROUP BY c.song_id
                                                             ORDER BY average DESC 
                                                             LIMIT $starting_limit, $limit");
            $show->execute();
            $shows = $show->fetchAll();
            $show_count = $show->rowCount();
            break;
    }
}

$_SESSION['sorting'] = $sorting;
$_SESSION['search'] = $search;