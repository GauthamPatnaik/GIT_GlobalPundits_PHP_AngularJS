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

</head>
<body>

<?php
include("header.html");
?>

<!-- content starts here -->
<!-- <div data-sal="slide-up" data-sal-duration="500" id="top-space"></div> -->
<div data-sal="slide-up" data-sal-duration="500" id="s-content-area" class="container-fluid">
    <div class="row align-items-top">
        <div data-sal="slide-up" data-sal-duration="500" data-sal-delay="100" class="col-lg-9 content-pane">
            <div id="s-content-1" class="container">
                <div class="row justify-content-center align-content-top">
                    <div class="col-lg-10">
                        <h1 class="acc-color">About Us</h1>
                        <p>Globalpundits is an enterprise IT solutions and staffing firm with specialized expertise in ERP applications and technologies. Our practice areas focus on:</p>
                        
                        <div class="s-emp-block">
                            <ul>
                                <li>ERP Professional Services including Oracle®, Banner®, Colleague® and Workday®</li>
                                <li>Managed services for Oracle®, Banner®, Colleague® and Workday®</li>
                                <li>Custom Software Development</li>
                                <li>Technical & Professional Staff Augmentation</li>
                                <li>IT Advisory Services</li>
                            </ul>
                        
                        </div>
                        <p>With over 20 years of experience Globalpundits is uniquely qualified to partner with you for your ERP services and staffing needs. Globalpundits proven resources are comprised of an experienced base of solution experts with a proven methodology that enables us to support the most diverse solutions on a global basis.</p>
                        <br>
                        <h3 class="acc-color">Globalpundits is guided by a set of core values that result in a superior client experience</h3>
                        <br>
                        <div class="row justify-content-between about-values">
                            <div class="col-lg-2">
                                <img src="images/Integrity.png" alt="Integrity" >
                                <h3 class="h3-center">Integrity</h3>
                                <p>First and foremost, maintain the highest standards of integrity toward our clients and colleagues.</p>
                            </div>
                            <div class="col-lg-2">
                                <img src="images/Excellence.png" alt="Excellence" >
                                <h3 class="h3-center">Excellence</h3>
                                <p>Strive for excellence in both practice and in people.</p>
                            </div>
                            <div class="col-lg-2">
                                <img src="images/Efficiency.png" alt="Efficiency" >
                                <h3 class="h3-center">Efficiency</h3>
                                <p>Maximize the efficiency of processes and services.</p>
                            </div>
                            <div class="col-lg-2">
                                <img src="images/Quality.png" alt="Quality" >
                                <h3 class="h3-center">Quality</h3>
                                <p>Constantly develop the quality of our skills and delivery.</p>
                            </div>
                            <div class="col-lg-2">
                                <img src="images/Standardization.png" alt="Standardization" >
                                <h3 class="h3-center">Standardization</h3>
                                <p>Execute with standard tools, methods, and processes.</p>
                            </div>
                        </div>

                        <h3 class="acc-color">For our clients, who we are is reflected in a differentiating value proposition</h3>
                        <div class="s-emp-block">
                            <ul>
                                <li>Full life-cycle services from strategy through managed services</li>
                                <li>Extraordinary consulting talent and expertise</li>
                                <li>Global reach and off-shore capabilities</li>
                                <li>Standard project execution and quality</li>
                            </ul>
                        </div>
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
<script src="js/template.js"></script>
</html>