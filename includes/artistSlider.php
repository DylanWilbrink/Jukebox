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

    <style>
        html, body {
            position: relative;
            height: 70%;
        }

        body {
            background: #708090;
            font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
            font-size: 14px;
            color: #000;
            margin: 0;
            padding: 0;
        }

        .swiper-container {
            background: #708090;
            width: 100%;
            min-height: 100%;
            height: auto
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            /* Center slide text vertically */
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
            cursor: pointer;
            background-size: cover;
            border: solid black 1px;
        }
    </style>
</head>
<body>
<div class="swiper-container">
    <div class="swiper-wrapper">
        <?php
        //Check if there are 5 artists
        if ($rows > 5) {
            foreach ($artists as $result) { ?>
                <div onclick="window.location='http://localhost/Jukebox/profile/profile.php?id=<?php echo $result['user_id']; ?>'"
                     class="swiper-slide"
                     style="background: url('<?php echo $result['profile_picture']; ?>') no-repeat; width: 300px; height: 300px;">
                    <h1 style="color: white; background:black; opacity: 0.7; width:100%; border-"><?php echo $functions->getUsername($result['user_id']); ?></h1>
                </div>
            <?php }
        } else { ?>
            <div class="swiper-slide" style="border-radius: 50%; background: #3E4551; overflow: hidden; width: 300px; height: 300px;">
                <h1 style="color: white; background:black; opacity: 0.7; width:100%;">Unknown</h1>
            </div>
            <div class="swiper-slide" style="border-radius: 50%; background: #3E4551; overflow: hidden; width: 300px; height: 300px;">
                <h1 style="color: white; background:black; opacity: 0.7; width:100%;">Unknown</h1>
            </div>
            <div class="swiper-slide" style="border-radius: 50%; background: #3E4551; overflow: hidden; width: 300px; height: 300px;">
                <h1 style="color: white; background:black; opacity: 0.7; width:100%;">Unknown</h1>
            </div>

        <?php } ?>
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