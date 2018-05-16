<?php
session_start();
$functions = new functions;

class functions
{
    //Create connection to DB
    public function connect()
    {
        $connect = new PDO('mysql:host=localhost; dbname=webdev_music', 'root', '');
        return $connect;
    }

    //Get the username by user_id
    public function getUsername($user_id)
    {
        $query = $this->connect()->prepare('SELECT username FROM users WHERE user_id = :user_id');
        $query->execute(array(
            ':user_id' => $user_id
        ));
        $result = $query->fetchAll();

        foreach ($result as $usernames) {
            $username = $usernames['username'];
        }
        return $username;
    }

    //Get the genre by genre_id
    public function getGenre($genre_id)
    {
        $query = $this->connect()->prepare('SELECT genre_title FROM genres WHERE genre_id = :genre_id');
        $query->execute(array(
            ':genre_id' => $genre_id
        ));
        $result = $query->fetchAll();

        if ($genre_id > 0) {
            foreach ($result as $genres) {
                $genre = $genres['genre_title'];
            }
        } else {
            $genre = '';
        }
        return $genre;
    }
    //Get the rank by rank_id
    public function getRank($user_id)
    {
        switch ($user_id) {
            case 0:
                echo 'User';
                break;
            case 1:
                echo 'Artist';
                break;
            case 2:
                echo 'Moderator';
                break;
            case 3:
                echo 'Administrator';
                break;
        }
    }
    //Get the report by report_id
    public function getReport($report_id)
    {
        switch ($report_id) {
            case 0:
                echo '';
                break;
            case 1:
                echo 'Being directly offensive to other users.';
                break;
            case 2:
                echo 'Inappropriate username, bio or profile picture.';
                break;
            case 3:
                echo 'Overall inappropiate behaviour.';
                break;
        }
    }
}