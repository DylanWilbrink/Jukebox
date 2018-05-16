<?php
include '../functions/functions.php';

if (isset($_POST['submit'])) {

//Check if form is filled
    if ($_POST['username'] && $_POST['password'] && $_POST['email'] && $_POST['first_name'] && $_POST['surname'] && $_POST['phone_number']) {
        //Insert into DB
        $query = $functions->connect()->prepare('INSERT INTO users (username, password, email, first_name, surname, phone_number, newsletter, rank) 
                                                      VALUES (:username, :password, :email, :first_name, :surname, :phone_number, :newsletter, :rank)');

        $query->execute(array(
            ':username' => $_POST['username'],
            ':password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            ':email' => $_POST['email'],
            ':first_name' => $_POST['first_name'],
            ':surname' => $_POST['surname'],
            ':phone_number' => $_POST['phone_number'],
            ':newsletter' => $_POST['newsletter'],
            ':rank' => $_POST['rank']
        ));
        echo 'Inserted';
        header('location: ../login/login.php');
        $_SESSION['error'] = '';
    } else {
        $_SESSION['error'] = 'Please fill out the entire form.';
        header('location: ../register/register.php');
    }
} else {
    echo 'Nothing was inserted';
}