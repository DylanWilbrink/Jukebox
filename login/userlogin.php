<?php
include '../functions/functions.php';
$username = $_POST['username'];
$password = $_POST['password'];

//Check if banned
$query = $functions->connect()->prepare('SELECT punishment FROM users WHERE username = :username');
$query->execute(array(
    ':username' => $username
));
$punishment = $query->fetchAll();

//Compare username to usernames in DB
$query = $functions->connect()->prepare('SELECT * FROM users WHERE username = :username');
$query->execute(array(
    ':username' => $username
));
$result = $query->fetchAll();

if (isset($_POST['submit'])) {
    //Display error if banned
    foreach ($punishment as $check_punishment) {
        if ($check_punishment['punishment'] > 1) {
            $_SESSION['loginError'] = 'You were banned';
            header('location: login.php');
        }
    }
    //Start logging in
    if (!empty($username) && !empty($password)) {
        $query = $functions->connect()->prepare("SELECT * FROM users WHERE username=? AND password=?");

        foreach ($result as $hash) {
            $hashed = password_verify($password, $hash['password']);

            $query->bindParam(1, $username);
            $query->bindParam(2, $hashed);
        }
        $query->execute();
//If logged in allow access to site
        if ($hashed == true) {
            foreach ($result as $results) {
                $_SESSION['user_id'] = $results['user_id'];
                $_SESSION['rank'] = $results['rank'];
                $_SESSION['username'] = $results['username'];
                $_SESSION['logged_in'] = true;
            }
            $_SESSION['loginError'] = '';
            header('location: http://localhost/Jukebox/home/home.php');
            exit;
        } else {
            $_SESSION['loginError'] = 'Wrong username or password';
            header('location: http://localhost/Jukebox/login/login.php');
        }
    } else {
        $_SESSION['loginError'] = 'Please enter an e-mail and password';
        header('location: http://localhost/Jukebox/login/login.php');
    }
}