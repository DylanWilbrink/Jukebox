<html>
<head>
    <?php
    include 'discover.php';
    include '../includes/links.php';
    ?>
    <link rel="stylesheet" href="../includes/headerStyle.css">
    <link rel="stylesheet" href="../includes/footerStyle.css">
    <link rel="stylesheet" href="discoverStyle.css">
</head>
<body>
<?php include '../includes/header.php'; ?>

<!--Search options-->
<div id="searchBarWrapper">
    <div id="searchBar">
        <form action="index.php" method="post">
            <select id="sorting" name="sort_by">
                <option value="0" <?php if ($_SESSION['sorting'] == 0) {
                    echo 'selected="selected"';
                } ?>>Newest
                </option>
                <option value="1" <?php if ($_SESSION['sorting'] == 1) {
                    echo 'selected="selected"';
                } ?>>Oldest
                </option>
                <option value="2" <?php if ($_SESSION['sorting'] == 2) {
                    echo 'selected="selected"';
                } ?>>Rating, Highest - Lowest
                </option>
                <option value="3" <?php if ($_SESSION['sorting'] == 3) {
                    echo 'selected="selected"';
                } ?>>Rating, Lowest - Highest
                </option>
            </select>
            <input id="search" type="text" name="search" placeholder="Search by title or artist"
                   value="<?php echo $_SESSION['search']; ?>">
            <input id="submit" type="submit" value="Search" name="submit_search">
        </form>
    </div>
</div>
<?php
//Check if songs have been uploaded
if ($show_count == 0) {
    echo 'No songs were uploaded yet';
} else {
    ?>
<!--    Display all songs-->
    <div id="content">
        <?php foreach ($shows as $result) { ?>

            <div onclick="window.location='../song/song.php?song=<?php echo $result['song_id']; ?>'" class="song"
                 style="background-image: url('../files/<?php echo $result['cover_image']; ?>')">
                <div class="title">
                    <?php echo strip_tags($result['title']); ?>
                    - <?php echo strip_tags($functions->getUsername($result['user_id'])); ?>
                </div>
            </div>
        <?php } ?>
    </div>

    <div id="pages">
        <?php
        for ($page = 1;
        $page <= $total_pages;
        $page++) { ?>
        <a class="link" href='<?php echo "?page=$page"; ?>'><?php echo $page;
            } ?>
        </a>
    </div>

<?php } ?>
<?php include '../includes/footer.php'; ?>
</body>
</html>