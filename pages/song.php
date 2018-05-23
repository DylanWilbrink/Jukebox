<html>
<head>
    <?php
    include '../php/songs.php';
    include '../includes/links.php';
    ?>
    <link rel="stylesheet" href="../style/songStyle.css">
    <script>
        //Play sound
        function play() {
            document.getElementById('player').play()
        }

        //Pause sound
        function pause() {
            document.getElementById('player').pause()
        }

        //Volume up
        function volumeUp() {
            document.getElementById('player').volume += 0.1
        }

        //Volume down
        function volumeDown() {
            document.getElementById('player').volume -= 0.1
        }

        //Progress bar
        function seek() {
            var player = document.getElementById('player');
            var progressBar = document.getElementById('seekbar');
            progressBar.value = (player.currentTime / player.duration);
        }
    </script>
</head>
<body>
<?php
include '../includes/header.php';
include '../includes/songslider.php';
?>

<div id="content">
    <?php foreach ($results as $result) { ?>
        <div id="music">
            <audio id="player" ontimeupdate="seek()">
                <source src="../files/<?php echo $result['song']; ?>" type="audio/ogg">
                <source src="../files/<?php echo $result['song']; ?>" type="audio/mp3">
                <source src="../files/<?php echo $result['song']; ?>" type="audio/wav">
            </audio>

            <button onclick="play()">Play</button>
            <button onclick="pause()">Pause</button>
            <progress id="seekbar" value="0" max="1"></progress>
            <button onclick="volumeUp()">+</button>
            <button onclick="volumeDown()">-</button>
        </div>
        <?php echo strip_tags($result['description']);
    } ?>
</div>


<div id="comments">
    <?php
    foreach ($average as $average_result) {
        echo 'Average: ' . number_format($average_result['average'], 1);
        $_SESSION['average'] = number_format($average_result['average'], 1);
    }
    ?>
    <?php foreach ($mute_results as $mute_result) {
        if ($mute_result['punishment'] == 1) {
            echo 'You can\'t comment when muted';
        } else {
            ?>
            <form action="../php/commenting.php?id=<?php echo $_GET['song']; ?>" method="post">
                <label for="comment"><?php if (!empty($_SESSION['commentError'])) {
                        echo $_SESSION['commentError'];
                    } else {
                        echo 'Leave your opinion';
                    } ?></label><br>
                <input id="rating" name="rating" type="number" value="1" min="1" max="10"><br>
                <textarea name="comment" id="comment"></textarea><br>
                <input id="placeComment" name="submit" type="submit" value="Submit">
            </form>
        <?php }
    } ?>
    <?php foreach ($comments as $comment) { ?>
        <div id="comment-content">
            <div id="comment-rating">
                Rating: <?php echo $comment['rating']; ?><br>
                <a class="link"
                   href="profile.php?id=<?php echo $comment['user_id'] ?>"><?php echo $functions->getUsername($comment['user_id']); ?></a><br>

                <?php echo $comment['created_at']; ?>
            </div>
            <div id="comment-comment">
                <?php echo strip_tags($comment['comment']); ?>
            </div>
        </div>
    <?php } ?>
</div>

<?php include '../includes/footer.php' ?>
</body>
</html>