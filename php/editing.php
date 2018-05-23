<?php
require_once '../functions/functions.php';
//Get file info
$errors = array();
$file_name = $_FILES['profile_picture']['name'];
$file_size = $_FILES['profile_picture']['size'];
$file_tmp = $_FILES['profile_picture']['tmp_name'];
$file_type = $_FILES['profile_picture']['type'];
$file_ext = strtolower(end(explode('.', $_FILES['profile_picture']['name'])));

//Check if no uploaded
if (!file_exists($file_tmp) || !is_uploaded_file($file_tmp)) {

    $query = $functions->connect()->prepare('SELECT * FROM users WHERE user_id = :user_id');
    $query->execute(array(
        ':user_id' => $_GET['id']
    ));
    $results = $query->fetchAll();

    foreach ($results as $result) {
        $new_picture_name = $result['profile_picture'];
    }
    header('location: ../pages/profile.php?id=' . $_GET['id']);
    //Check requirements
} else {
    $expensions = array('jpg', 'jpeg', 'png');

    if (in_array($file_ext, $expensions) === false) {
        $errors[1] = 'Filetype not allowed';
    }

    if ($file_size > 320000000) {
        $errors[2] = 'File size too large';
    }

    $type = explode(".", $_FILES["profile_picture"]["name"]);
    $new_picture_name = uniqid('') . '.' . end($type);
//Start uploading if no errors
    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, '../../files/' . $new_picture_name);
        header('location: ../pages/profile.php?id=' . $_GET['id']);
        echo 'Uploaded image';
    } else {
        echo 'No image uploaded';
        echo $errors[1] . ' ' . $errors[2];
    }
}
//Insert data in DB
if (isset($_POST['submit'])) {
    $query = $functions->connect()->prepare('UPDATE users
                                                  SET username = :username, 
                                                  email = :email, 
                                                  first_name = :first_name, 
                                                  surname = :surname, 
                                                  phone_number = :phone_number, 
                                                  profile_picture = :profile_picture, 
                                                  bio = :bio
                                                  WHERE user_id = :user_id');

    $query->execute(array(
        ':username' => $_POST['username'],
        ':email' => $_POST['email'],
        ':first_name' => $_POST['first_name'],
        ':surname' => $_POST['surname'],
        ':phone_number' => $_POST['phone_number'],
        ':profile_picture' => $new_picture_name,
        ':bio' => $_POST['bio'],
        ':user_id' => $_GET['id']
    ));
}