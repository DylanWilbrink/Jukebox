<html>
<head>
    <?php
    include 'gethome.php';
    include '../includes/links.php';
    if ($_SESSION['logged_in'] == false) {
        header('location: http://localhost/Jukebox/login/login.php');
    } ?>
</head>
<body>
<?php include '../includes/header.php'; ?>

<?php include '../includes/slider.php'; ?>
<div style="text-align: center; background: #708090; color: white;"><h1>New artists</h1></div>
<?php include '../includes/artistSlider.php'; ?>
<div style="text-align: center; background: #708090; color: white;"><h1>New releases</h1></div>
<?php include '../includes/itemSlider.php'; ?>
<?php include '../includes/footer.php'; ?>

</body>
</html>