<?php
require_once '../functions/functions.php';
//Select all accepted songs
$query = $functions->connect()->prepare('SELECT * FROM songs WHERE pending = 0');
$query->execute();
$results = $query->fetchAll();