<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>About Us</title>
    <link rel="stylesheet" href="css/fontawesome/css/all.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/style-anim.css">
    <link rel="stylesheet" href="css/style-about.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/U-1.png" type="image/x-icon">

</head>

<body>

<?php
    require "partioal/_header.php";
    ?>

    <div class="header">

        <!--Content before waves our Heading on the top-->
        <div class="inner-header flex">
            <h1>This is our About Us page</h1>
        </div>

        <!--Waves Container-->
        <div>
            <svg class="waves" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="">
            <defs>
            <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="parallax">
            <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
            <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
            <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
            <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
            </g>
            </svg>
        </div>
        <!--Waves end-->

    </div>
    <!--Header ends-->
    <div class="container my-5">
        <div class="row justify-content-center">
            <!-- partial:index.partial.html -->
            <div class="person">
                <div class="container-1">
                    <div class="container-1-inner">
                        <img class="circle" src="img/13.jpg" />
                        <img class="img img1" src="img/U-3.png" />
                    </div>
                </div>
                <div class="divider"></div>
                <div class="name">Usman Khan</div>
                <div class="title">Product Manager</div>
            </div>
            <!-- 2nd -->
            <div class="person">
                <div class="container-1">
                    <div class="container-1-inner">
                        <img class="circle" src="img/11.jpg" />
                        <img class="img img1" src="img/U-2.png" />
                    </div>
                </div>
                <div class="divider"></div>
                <div class="name">Umar</div>
                <div class="title">Senior Developer</div>
            </div>
            <!-- 3th -->
            <div class="person">
                <div class="container-1">
                    <div class="container-1-inner">
                        <img class="circle" src="img/12.jpg" />
                        <img class="img img1" src="img/U-1.png" />
                    </div>
                </div>
                <div class="divider"></div>
                <div class="name">Usman ali</div>
                <div class="title">Senior Designer</div>
            </div>
        </div>
    </div>
    <!-- Footer start from here -->
    <?php
    require "partioal/_footer.php";
    ?>

</body>

</html>