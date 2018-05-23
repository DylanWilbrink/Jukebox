<?php
require_once __DIR__ . '/../functions/functions.php';
//Get most popular songs
$query = $functions->connect()->prepare('SELECT *, AVG(c.rating) AS average FROM songs s
                                                  JOIN comments c ON c.song_id = s.song_id
                                                  WHERE s.pending = 0
                                                  GROUP BY s.song_id
                                                  ORDER BY average DESC
                                                  LIMIT 10');
$query->execute();
$results = $query->fetchAll();

//Get new artists
$query = $functions->connect()->prepare('SELECT * FROM users
                                                  WHERE rank = 1
                                                  ORDER BY user_id DESC
                                                  LIMIT 10');
$query->execute();
$artists = $query->fetchAll();
$rows = $query->rowCount();

//Get newest songs
$query = $functions->connect()->prepare('SELECT * FROM songs
                                                  ORDER BY song_id DESC
                                                  LIMIT 10');
$query->execute();
$songs = $query->fetchAll();
$song_rows = $query->rowCount();