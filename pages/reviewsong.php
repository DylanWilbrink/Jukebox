<html>
<head>
    <?php include '../php/songadmin.php';
    include '../includes/links.php';
    ?>
    <link rel="stylesheet" href="../style/adminStyle.css">
</head>
<body>
<?php include '../includes/header.php';
?>
<!--display all pending songs-->
<div id="content">
    <table id="contentTable">
        <tr class="titleRow">
            <td>
                Title
            </td>
            <td>
                Artist
            </td>
            <td>
                Genre
            </td>
            <td>
                Description
            </td>
        </tr>

        <?php foreach ($results as $result) { ?>
            <tr class="userRow" onclick="window.location='http://localhost/Jukebox/pages/acceptsongs.php?id=<?php echo $result['song_id'] ?>'">
                <td>
                    <?php echo strip_tags($result['title']); ?>
                </td>
                <td>
                    <?php echo strip_tags($functions->getUsername($result['user_id'])); ?>
                </td>
                <td>
                    <?php echo $functions->getGenre($result['genre']); ?>
                </td>
                <td>
                    <?php echo strip_tags($result['description']); ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
</body>
</html>