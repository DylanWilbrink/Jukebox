<html>
<head>
    <?php
    require_once '../functions/functions.php';
    include '../includes/links.php';
    include '../php/profiling.php';
    ?>
    <link rel="stylesheet" href="../style/profileStyle.css">

    <script>
        function about() {
            document.getElementById('tracks').style.display = 'none';
            document.getElementById('about').style.display = 'block';
        }

        function tracks() {
            document.getElementById('about').style.display = 'none';
            document.getElementById('tracks').style.display = 'table';
        }
    </script>
</head>
<body>
<?php include '../includes/header.php'; ?>

<div id="content">
    <div id="head">
        <?php foreach ($results

        as $result) { ?>
        <img id="profile-picture" src="../files/<?php echo $result['profile_picture']; ?>"
             alt="<?php echo $result['user_id']; ?>" height="300">

        <span id="text">
            <h2><?php echo $result['username'] ?></h2>
            <?php echo $result['first_name'] . ' ' . $result['surname']; ?> <sup><a class="link"
                                                                                    href="report.php?id=<?php echo $_GET['id']; ?>">Report</a></sup>
            <br><br>
        <div class="tag">
            <?php echo $functions->getRank($result['rank']); ?>
        </span>
    </div>
    <br><br>
    <?php if ($_GET['id'] == $_SESSION['user_id']) { ?>
        <a class="link" href="editprofile.php?id=<?php echo $_GET['id'] ?>">Edit profile</a>
    <?php } ?>
</div>

    <div id="selector">
        <div id="left" onclick="about()">
            <h3>About</h3>
        </div>
        <div id="right" onclick="tracks()">
            <h3>Tracks</h3>
        </div>
    </div>

    <div id="about">
        <h2 style="text-align: center">About <?php echo $result['username']; ?></h2>

        <div style="text-align: center"><?php echo nl2br($result['bio']); ?></div>

        <table id="infoTable">
            <tr>
                <td colspan="2" class="title">
                    General information
                </td>
            </tr>
            <tr>
                <td class="cell">
                    Comments placed
                </td>
                <td class="cell">
                    <?php echo $comment_count ?>
                </td>
            </tr>
            <tr>
                <td class="cell">
                    Songs uploaded
                </td>
                <td class="cell">
                    <?php echo $song_count; ?>
                </td>
            </tr>
            <tr>
                <td class="cell">
                    Member since
                </td>
                <td class="cell">
                    <?php echo $result['created_at']; ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="title">
                    <a class="link"
                       href="mailto:<?php echo $result['email']; ?>">Contact <?php echo $result['username']; ?></a>
                </td>
            </tr>
        </table>
    </div>

    <div id="tracks" style="display: none;">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php foreach ($song_results as $song) { ?>
                    <div onclick="window.location='http://localhost/Jukebox/pages/song.php?song=<?php echo $song['song_id']; ?>'"
                         class="swiper-slide"
                         style="background: url('<?php echo $song['cover_image']; ?>') no-repeat; background-size: cover; width: 300px; height: 300px; cursor: pointer;">
                        <h1 style="color: white; background:black; opacity: 0.7; width:100%;"><?php echo $song['title']; ?>
                            - <?php echo $functions->getUsername($song['user_id']); ?></h1>
                    </div>
                <?php } ?>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </div>

        <script>
            var swiper = new Swiper('.swiper-container', {
                slidesPerView: 'auto',
                centeredSlides: true,
                spaceBetween: 20,
                observer: true,
                observeParents: true,
                loop: true
            });
        </script>
<?php } ?>
<?php include '../includes/footer.php'; ?>
</body>
</html>