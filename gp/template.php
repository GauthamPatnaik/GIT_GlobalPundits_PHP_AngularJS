<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0D2940" />
    <!-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> -->
    <title>Globalpundits Inc.</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/secondary.css">
	<link rel="stylesheet" type="text/css" href="css/main-mobile.css">
    <link rel="stylesheet" type="text/css" href="css/sal.css">
    <link rel="stylesheet" href="css/bxSlider.css">

    <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Poppins:700" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenMax.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parallax/3.1.0/parallax.min.js"></script>
    <script src="js/sal.js"></script>
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
    <script src="js/anime.min.js"></script>

    <script src="js/template.js"></script>
</head>
<body>

<?php
include("header.html");
?>

<!-- content starts here -->
<!-- <div id="top-space"></div> -->
<div data-sal="slide-up" data-sal-duration="500" id="s-content-area" class="container-fluid">
    <div class="row align-items-top">
        <div class="col-lg-9 content-pane">
            <div data-sal="slide-up" data-sal-duration="500" data-sal-delay="100" id="s-content-1" class="container">
                <div class="row justify-content-center align-content-top">
                    <div class="col-lg-10">
                        <h1 class="acc-color">Main Heading</h1>
                        <p>Globalpundits is an enterprise IT solutions and staffing firm with specialized expertise in ERP applications and technologies. Our practice areas focus on:</p>
                        
                        <div class="s-emp-block">
                            <ul>
                                <li>ERP Professional Services including Oracle®, Banner® and Workday®</li>
                                <li>Managed services for Oracle®, Banner® and Workday®</li>
                                <li>Custom Software Development</li>
                                <li>IT Staff Augmentation</li>
                                <li>IT Advisory Services</li>
                            </ul>
                        
                        </div>
                        <p>With over 17 years of experience Globalpundits is uniquely qualified to partner with you for your ERP services and staffing needs. Globalpundits proven resources are comprised of an experienced base of solution experts with a proven methodology that enables us to support the most diverse solutions on a global basis.</p>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 actions-pane">
            <?php
                include("sidebar.html");
            ?>
        </div>
    </div>
</div>
<!-- content ends here -->

<?php
include("footer.html");
?>

</body>
<script src="js/header.js"></script>
</html>