<html>
<head>
    <link rel="stylesheet" href="../style/adminStyle.css">
    <?php
    require_once '../php/accepting.php';
    include '../includes/links.php';
    ?>
</head>
<body>
<?php include '../includes/header.php';?>

<!--display all requested songs-->
<div id="content">
    <form action="../php/accepting.php?id=<?php echo $_GET['id']; ?>" method="post">
        <table id="contentTable">
            <?php foreach ($results as $result) { ?>
                <tr style="text-align: center;">
                    <td>
                        Title: <?php echo strip_tags($result['title']); ?>
                    </td>
                    <td>
                        Genre: <?php echo strip_tags($functions->getGenre($result['genre'])); ?>
                    </td>
                </tr>
                <tr style="text-align: center;">
                    <td>
                        Artist: <?php echo strip_tags($functions->getUsername($result['user_id'])); ?>
                    </td>
                    <td>
                        Description: <?php echo strip_tags($result['description']); ?>
                    </td>
                </tr>
                <tr style="text-align: center;">
                    <td>
                        <img src="../../files/<?php echo $result['cover_image']; ?>" alt="Cover image" height="200" width="200">
                    </td>
                    <td>
                        <audio controls>
                            <source src="../../files/<?php echo $result['song']; ?>" type="audio/ogg">
                            <source src="../../files/<?php echo $result['song']; ?>" type="audio/mp3">
                            <source src="../../files/<?php echo $result['song']; ?>" type="audio/wav">
                        </audio>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="border-bottom: solid black 1px;"></td>
                </tr>
                <tr style="text-align: center;">
                    <td>
                        <input type="submit" name="accept" value="Accept">
                    </td>
                    <td>
                        <input type="submit" name="deny" value="Deny">
                    </td>

                </tr>
            <?php } ?>
        </table>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
</body>
</html>