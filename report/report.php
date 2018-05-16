<html>
<head>
    <?php
    include 'reporting.php';
    include '../includes/links.php';
    $user_id = $_GET['id'];
    ?>
    <link rel="stylesheet" href="reportStyle.css">
</head>
<body>
<?php include '../includes/header.php'; ?>

<div id="content">
    <form action="reporting.php?id=<?php echo $user_id ?>" method="post">
        Report user: <?php echo $functions->getUsername($user_id); ?><br>
        <select name="offense" id="report">
            <option value="0">-- Select --</option>
            <option value="1">Being directly offensive to other users.</option>
            <option value="2">Inappropriate username, bio or profile picture.</option>
            <option value="3">Overall inappropiate behaviour.</option>
        </select>
        <br>
        <textarea name="report_comment" id="report_comment"></textarea><br>
        <input type="submit" value="Report" name="submit">
    </form>
</div>

<?php include '../includes/footer.php'; ?>
</body>
</html>