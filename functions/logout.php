<?php
//Log out function
session_start();
session_destroy();

header('location: ../pages/login.php');