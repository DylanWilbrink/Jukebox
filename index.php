<html>
<head>
    <?php
    include_once 'php/gethome.php';
    include_once 'includes/links.php';
    if ($_SESSION['logged_in'] == false) {
        header('location: http://localhost/Jukebox/pages/login.php');
    } ?>
</head>
<body>
<?php include_once 'includes/header.php'; ?>

<?php include_once 'includes/slider.php'; ?>
<div style="text-align: center; background: #708090; color: white;"><h1>New artists</h1></div>
<?php include_once 'includes/artistSlider.php'; ?>
<div style="text-align: center; background: #708090; color: white;"><h1>New releases</h1></div>
<?php include_once 'includes/itemSlider.php'; ?>
<?php include_once 'includes/footer.php'; ?>

</body>
</html>