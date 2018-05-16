<?php
include '../functions/functions.php';

//Check if logged in and if artist
if ($_SESSION['logged_in'] == false) {
    header('location: http://localhost/Jukebox/login/login.php');
    exit;
} else {
    if ($_SESSION['rank'] < 1) {
        header('location: http://localhost/Jukebox/errorpage/index.php');
        exit;
    }
}

//Select all genres
$query = $functions->connect()->prepare('SELECT * FROM genres');
$query->execute();
$results = $query->fetchAll();

if (isset($_POST['submit'])) {
    //Check if form is filled
    if (empty($_FILES['song']) || empty($_POST['title']) || empty($_FILES['cover_image']) || $_POST['genre'] == 0) {
        $_SESSION['uploadError'] = 'Please fill in the entire form.';
        header('location: upload.php');
    } else {
        //File handling
        if (isset($_FILES['song'])) {
            $errors = array();
            $file_name = $_FILES['song']['name'];
            $file_size = $_FILES['song']['size'];
            $file_tmp = $_FILES['song']['tmp_name'];
            $file_type = $_FILES['song']['type'];
            $file_ext = strtolower(end(explode('.', $_FILES['song']['name'])));
            $expensions = array('ogg', 'mp3', 'wav');

            if (in_array($file_ext, $expensions) === false) {
                $errors[] = 'Not allowed';
            }

            if ($file_size > 320000000) {
                $errors[] = 'File size too large';
            }

            $type = explode(".", $_FILES["song"]["name"]);
            $new_file_name = uniqid('') . '.' . end($type);

            if (empty($errors) == true) {
                move_uploaded_file($file_tmp, '../files/' . $new_file_name);
                echo 'Uploaded song';
            } else {
                echo 'No song uploaded';
                echo $errors;
            }
        } else {
            echo 'Nothing was selected';
        }
        //File handling
        if (isset($_FILES['cover_image'])) {
            $errors = array();
            $file_name = $_FILES['cover_image']['name'];
            $file_size = $_FILES['cover_image']['size'];
            $file_tmp = $_FILES['cover_image']['tmp_name'];
            $file_type = $_FILES['cover_image']['type'];
            $file_ext = strtolower(end(explode('.', $_FILES['cover_image']['name'])));
            $expensions = array('jpg', 'jpeg', 'png');

            if (in_array($file_ext, $expensions) === false) {
                $errors[] = 'Not allowed';
            }

            if ($file_size > 320000000) {
                $errors[] = 'File size too large';
            }

            $type = explode(".", $_FILES["cover_image"]["name"]);
            $new_cover_name = uniqid('') . '.' . end($type);
        }

        //Upload if no errors
        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, '../files/' . $new_cover_name);
            echo 'Uploaded image';
        } else {
            echo 'No image uploaded';
            echo $errors;
        }

        //Insert song to be reviewed
        $query = $functions->connect()->prepare('INSERT INTO songs (user_id, song, cover_image, title, genre, description)
                                                      VALUES (:user_id, :song, :cover_image, :title, :genre, :description)');
        $query->execute(array(
            ':user_id' => $_SESSION['user_id'],
            ':song' => $new_file_name,
            ':cover_image' => '../files/' . $new_cover_name,
            ':title' => $_POST['title'],
            ':genre' => $_POST['genre'],
            ':description' => $_POST['description']
        ));

        echo '<br>Inserted';
        header('location: ../home/home.php');

    }
}