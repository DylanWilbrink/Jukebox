<html>
<head>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="http://localhost/Jukebox/pages/profile.php?id=<?php echo $_SESSION['user_id']; ?>">Welcome, <?php echo $_SESSION['username'] ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="http://localhost/Jukebox/index.php">Home <span
                            class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Discover
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="http://localhost/Jukebox/pages/discovering.php">Songs</a>
                    <a class="dropdown-item" href="#">Artists</a>
                </div>
            </li>
            <a href="http://localhost/Jukebox/pages/profile.php?id="></a>
        </ul>
        <?php if ($_SESSION['rank'] >= 2) { ?>
        <ul class="navbar-nav mr-right">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    Admin panel
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="http://localhost/Jukebox/pages/acceptsongs.php">Accept
                        songs</a>
                    <a class="dropdown-item" href="http://localhost/Jukebox/pages/removesongs.php">Remove
                        songs</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="http://localhost/Jukebox/adminpanel/pages/userlist.php">Users</a>
                    <a class="dropdown-item" href="http://localhost/Jukebox/adminpanel/pages/reported.php">Reports</a>
                </div>
            </li>
            <?php } ?>

            <?php if ($_SESSION['rank'] >= 1) { ?>
            <a class="nav-link" href="http://localhost/Jukebox/pages/upload.php">Upload</a>
            <?php } ?>
                <a class="nav-link" href="http://localhost/Jukebox/functions/logout.php">Logout</a>
        </ul>
</nav>
</body>
</html>