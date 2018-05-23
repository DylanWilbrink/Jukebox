<html>
<head>
    <?php include '../php/users.php';
    include '../includes/links.php';
    ?>
    <link rel="stylesheet" href="../style/adminStyle.css">
</head>
<body>
<?php include '../includes/header.php';?>

<div style="width: 100%; height: auto; overflow-x: scroll;">
    <form action="../php/users.php" method="post">
        <table id="userTable">
            <tr>
                <td>
                    <input type="text" name="search" placeholder="Search"
                           value=<?php echo $_SESSION['user_search']; ?>>
                    <input type="submit" value="Search" name="submit">
                </td>
                <td>
                    Total users: <?php echo $total_results; ?>
                </td>
            </tr>
            <tr class="titleRow">
                <td>
                    Username
                </td>
                <td>
                    E-mail
                </td>
                <td>
                    Full name
                </td>
                <td>
                    Phone number
                </td>
                <td>
                    Rank
                </td>
                <td>
                    Member since
                </td>
            </tr>
            <?php foreach ($users as $result) { ?>
                <tr class="userRow"
                    onclick="window.location='http://localhost/Jukebox/pages/profile.php?id=<?php echo $result['user_id']; ?>'">
                    <td>
                        <?php echo strip_tags($functions->getUsername($result['user_id'])); ?>
                    </td>
                    <td>
                        <?php echo strip_tags($result['email']); ?>
                    </td>
                    <td>
                        <?php echo strip_tags($result['first_name']) . ' ' . strip_tags($result['surname']); ?>
                    </td>
                    <td>
                        <?php echo strip_tags($result['phone_number']); ?>
                    </td>
                    <td>
                        <?php echo strip_tags($functions->getRank($result['rank'])); ?>
                    </td>
                    <td>
                        <?php echo $result['created_at']; ?>
                    </td>
                </tr>
            <?php }
            for ($page = 1;
            $page <= $total_pages;
            $page++) { ?>
            <a href='<?php echo "?page=$page"; ?>'><?php echo $page;
                } ?>
            </a>

        </table>
    </form>
</div>

<?php include '../includes/footer.php'; ?>
</body>
</html>