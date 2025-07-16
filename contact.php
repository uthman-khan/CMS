<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/U-1.png" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/style-contact.css">
    <link rel="stylesheet" href="css/fontawesome/css/all.css">

    <title>Contact Us</title>
</head>

<body>
<?php
    require "partioal/_header.php";
    ?>
    <hr color="#fff" class="w-75 mx-auto">

    <!-- This is Top NavBar or Header Close Here................................. -->

    <div class="container" style="position: relative;">
        <div class="row m-auto">
            <div class="offset-md-2 col-md-8">

                <form id="contact" action="" method="post">

                    <h3>Colorlib Contact Form</h3>
                    <h4>Contact us for custom quote</h4>
                    <fieldset>
                        <input placeholder="Your name" type="text" tabindex="1" required autofocus>
                    </fieldset>
                    <fieldset>
                        <input placeholder="Your Email Address" type="email" tabindex="2" required>
                    </fieldset>
                    <fieldset>
                        <input placeholder="Your Phone Number (optional)" type="tel" tabindex="3" required>
                    </fieldset>
                    <fieldset>
                        <input placeholder="Your Web Site (optional)" type="url" tabindex="4" required>
                    </fieldset>
                    <fieldset>
                        <textarea placeholder="Type your message here...." tabindex="5" required></textarea>
                    </fieldset>
                    <fieldset>
                        <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Submit</button>
                    </fieldset>
                </form>
            </div>
            <div class="offset-md-2"></div>
        </div>
    </div>
    <hr color="#fff" class="w-75 mx-auto">
    <!-- Footer start from Here -->
    <?php
    require "partioal/_footer.php";
    ?>
</body>

</html>