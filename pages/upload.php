<html>
<head>
    <?php include '../php/uploading.php';
    include '../includes/links.php';
    ?>
    <link rel="stylesheet" href="../style/uploadStyle.css">
</head>
<body>
<div id="container">
    <?php include '../includes/header.php'; ?>

    <div id="content">
        <form action="../php/uploading.php" method="post" enctype="multipart/form-data">
            <?php if (isset($_SESSION['uploadError'])) {
                echo $_SESSION['uploadError'];
            } else {
                echo 'Upload your song.';
            } ?><br>
            Song: <br>
            <input class="inputType" type="file" name="song"><br>
            Title: <br>
            <input class="inputType" type="text" name="title" placeholder="Title"> <br>
            Cover: <br>
            <input class="inputType" type="file" name="cover_image"> <br>
            Genre: <br>
            <select name="genre" id="genre"> <br>
                <option value="0">Choose a genre</option>
                <?php foreach ($results as $genre) {
                    echo '<option class="inputType" value="' . $genre['genre_id'] . '">' . $genre['genre_title'] . '</option>';
                }
                ?>
            </select><br>
            Description: <br>
            <textarea id="desc" name="description" cols="30" rows="10" placeholder="Description"></textarea> <br>
            <input class="inputType" type="submit" value="Upload" name="submit"> <br>
        </form>
    </div>

    <?php include '../includes/footer.php'; ?>
</div>
</body>
</html>