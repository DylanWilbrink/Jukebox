<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . '/../php/gethome.php'; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.2/css/swiper.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.2/css/swiper.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.2/js/swiper.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.2/js/swiper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.2/js/swiper.esm.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.2.2/js/swiper.esm.bundle.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

</head>
<body>
<div class="swiper-container">
    <div class="swiper-wrapper">
    <?php
    //Check if there are 5 songs
    if ($song_rows < 5) {
        ?>
        <div class="swiper-slide" style="background: #3E4551; overflow: hidden; width: 300px; height: 300px;">
            <h1 style="color: white; background:black; opacity: 0.7; width:100%;">Unknown</h1>
        </div>
        <div class="swiper-slide" style="background: #3E4551; overflow: hidden; width: 300px; height: 300px;">
            <h1 style="color: white; background:black; opacity: 0.7; width:100%;">Unknown</h1>
        </div>
        <div class="swiper-slide" style="background: #3E4551; overflow: hidden; width: 300px; height: 300px;">
            <h1 style="color: white; background:black; opacity: 0.7; width:100%;">Unknown</h1>
        </div>
        <div class="swiper-slide" style="background: #3E4551; overflow: hidden; width: 300px; height: 300px;">
            <h1 style="color: white; background:black; opacity: 0.7; width:100%;">Unknown</h1>
        </div>
        <div class="swiper-slide" style="background: #3E4551; overflow: hidden; width: 300px; height: 300px;">
            <h1 style="color: white; background:black; opacity: 0.7; width:100%;">Unknown</h1>
        </div>
        <?php
    } else {
        //Display songs
        foreach ($songs as $result) { ?>
            <div onclick="window.location='http://localhost/Jukebox/pages/song.php?song=<?php echo $result['song_id']; ?>'"
                 class="swiper-slide"
                 style="background: url('<?php echo $result['cover_image']; ?>') no-repeat; background-size: cover; width: 300px; height: 300px;">
                <h1 style="color: white; background:black; opacity: 0.7; width:100%;"><?php echo $result['title']; ?>
                    - <?php echo $functions->getUsername($result['user_id']); ?></h1>
            </div>
        <?php }
    } ?>
</div>
<!-- Add Pagination -->
<div class="swiper-pagination"></div>
</div>

<script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 'auto',
        centeredSlides: true,
        spaceBetween: 30,
        loop: true,
        autoplay: {
            delay: 2500,
            disableOnInteraction: true,
        }
    });
</script>

</body>
</html>