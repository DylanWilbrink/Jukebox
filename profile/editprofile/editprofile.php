<html>
<head>
    <style>
        #content {
            text-align: center;
        }

        #bio {
            resize: none;
            height: 400px;
            width: 300px;
        }
    </style>
    <?php
    include '../../functions/functions.php';
    include '../../includes/links.php';
    if ($_GET['id'] <> $_SESSION['user_id']) {
        header('location: ../../errorpage/index.php');
    }

    $query = $functions->connect()->prepare('SELECT * FROM users WHERE user_id = :user_id');
    $query->execute(array(
        ':user_id' => $_GET['id']
    ));
    $user_results = $query->fetchAll();
    ?>
    <link rel="stylesheet" href="../../includes/headerStyle.css">
    <link rel="stylesheet" href="../../includes/footerStyle.css">
    <link rel="stylesheet" href="../profileStyle.css">
</head>
<body>
<?php include '../../includes/header.php'; ?>

<div id="content">
    <form action="editing.php?id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data">
        <?php foreach ($user_results as $result) { ?>
            Username: <br>
            <input type="text" name="username" value="<?php echo $result['username'] ?>"><br>
            Profile picture: <br>
            <input type="file" name="profile_picture" value="../../files/<?php echo $result['profile_picture']; ?>"><br>
            E-mail: <br>
            <input type="text" name="email" value="<?php echo $result['email'] ?>"><br>
            Phone number: <br>
            <input type="text" name="phone_number" value="<?php echo $result['phone_number'] ?>"><br>
            First name: <br>
            <input type="text" name="first_name" value="<?php echo $result['first_name'] ?>"><br>
            Surname: <br>
            <input type="text" name="surname" value="<?php echo $result['surname'] ?>"><br>
            Bio: <br>
            <textarea name="bio" id="bio"><?php echo $result['bio'] ?></textarea><br>
            <input type="submit" name="submit" value="Update">
        <?php } ?>
    </form>
</div>

<?php include '../../includes/footer.php'; ?>
</body>
</html>