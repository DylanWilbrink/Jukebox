<html>
<head>
    <link rel="stylesheet" href="../style/adminStyle.css">
    <?php include '../php/remove.php';
    include '../includes/links.php';
    ?>
</head>
<body>
<?php include '../includes/header.php';?>
<!--Display all accepted songs-->
<div style="width: 100%; height: auto; overflow-x: scroll;">
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
                <td>Remove</td>
            </tr>
            <?php foreach ($results as $result) { ?>
                <tr class="userRow" onclick="window.location='http://localhost/Jukebox/pages/song.php?song=<?php echo $result['song_id']; ?>'">
                    <td>
                        <?php echo strip_tags($result['title']); ?>
                    </td>
                    <td>
                        <?php echo strip_tags($functions->getUsername($result['user_id'])); ?>
                    </td>
                    <td>
                        <?php echo strip_tags($functions->getGenre($result['genre'])); ?>
                    </td>
                    <td>
                        <?php echo strip_tags($result['description']); ?>
                    </td>
                    <td>
                        <a class="userLink" href="../php/delete.php?id=<?php echo $result['song_id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
</div>

<?php include '../includes/footer.php'; ?>
</body>
</html>