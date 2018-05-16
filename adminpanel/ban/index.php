<html>
<head>
    <?php
    include '../../functions/functions.php';
    include '../../includes/links.php';
    $id = $_GET['id'];

    //Check if logged in and if moderator
    if ($_SESSION['logged_in'] == false) {
        header('location: http://localhost/Jukebox/login/login.php');
    } else {
        if ($_SESSION['rank'] < 2) {
            header('location: http://localhost/Jukebox/errorpage/index.php');
        }
    }
    ?>
    <link rel="stylesheet" href="../adminStyle.css">
</head>
<body>
<?php
include '../../includes/header.php';
?>
<!--Select punishment-->
<div style="text-align: center;">
    <form action="banuser.php?id=<?php echo $id; ?>" method="post">
        <select name="punishment" id="punishment">
            <option value="0">No punishment</option>
            <option value="1">Mute user</option>
            <option value="2">Ban user</option>
            <option value="3">Terminate user</option>
        </select><br>
        <textarea name="explanation" id="explanation" cols="30" rows="10"></textarea><br>
        <input type="submit" name="submit" value="Submit">
    </form>
</div>

<?php include '../../includes/footer.php'; ?>
</body>
</html>