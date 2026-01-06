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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>

</head>
<body>

<?php
include("header.html");
?>

<!-- content starts here -->
<!-- <div data-sal="slide-up" data-sal-duration="500" id="top-space"></div> -->
<div data-sal="slide-up" data-sal-duration="500" id="s-content-area" class="container-fluid">
    <div class="row align-items-top justify-content-center">
        <div class="col-lg-10">
            <h1 class="acc-color">Testing As A Service (TAAS)</h1>
            <br>
            <div class="row">
                <div class="col-lg">
                    <h3 class="acc-color">Testing as a Service Project Lifecycle</h3>
                    <p>Repeatable automated tests assure quality without compromising efficiency</p>
                </div>
                <div class="col-lg">
                    <h3 class="acc-color">Management Reporting Dashboards</h3>
                    <p>Test results include screenshots of all test actions showing all mouse clicks and keyboard actions to comply with Change Management, Quality Assurance, Testing and Training Documentation</p>
                </div>
            </div>

            <hr><br>

            <div class="row">
                <div class="col-lg">
                    <h3 class="acc-color">TaaS Use Cases:</h3>
                    <p>Multiple functional test scripts can be executed by different users in separate modules at the same time. Service includes load testing using all devices, all mobile operating system. Globalpundits’s pre-created stress/load scripts include simulation of real thinking (or wait) time.</p>

                    <p><strong>Result:</strong> Measured response time of system, applications, modules, and pages</p>
                    <p><strong>Result:</strong> Reports & Dashboards include compared response time across different times, browsers, and devices.</p>
                </div>

                <div class="col-lg-4">
                    <img src="images/taas.png" alt="GP Testing As A service">
                </div>
            </div>

        </div>
    </div>
</div>

<div class="container-fluid grad-bg" id="">
    <h1 class="text-center h1-center h1-white">Automated Testing as a Service</h1>
    <p class="h1-tag text-center">Free up your User Testing Time by 80%</p>
</div>

<div data-sal="slide-up" data-sal-duration="500" id="" class="container white-bg content-padding">
    <div class="row align-items-top justify-content-center">
        <div class="col-lg-10">
            <div class="s-emp-block">
                <h3 class="acc-color h3-center">Challenges for Customers</h3>
                <ul>
                    <li>Repetitive testing requirements during upgrades, bundles, patches, and updates new module/application implementations, and customizations</li>
                    <li>Coordinating time across departments for frequent regulatory updates (Tax, 1099, Financial Aid)</li>
                    <li>Traditional testing methods are time consuming and do not enforce consistent quality</li>
                </ul>
            </div>
            <br>
            <div class="row">
                <div class="col-lg">
                    <h3 class="acc-color">Benefits Automated Testing as a Service:</h3>

                    <ul>
                        <li>Our pre-created test scripts using your set up data result in 80% less testing time</li><br>
                        <li>Integrated end-to-end testing between modules and applications</li><br>
                        <li>Our intelligent test scripts handle user decisions, errors and warnings</li><br>
                        <li>Assure Quality before a change is migrated</li><br>
                        <li>Catch anomalies before applying bundles/patches</li><br>
                        <li>A repeatable, automated testing lifecycle provides quality and efficiency</li>
                    </ul>
                </div>
                <div class="col-lg">
                    <h3 class="acc-color">Time Saving Benefits Testing as a Service:</h3>
                    <canvas id="myChart" width="500" height="250"></canvas>
                </div>
            </div>
            <br><br>
        </div>
    </div>
</div>
<br>
<!-- content ends here -->

<?php
include("footer.html");
?>

</body>
<script>
    var ctx = document.getElementById("myChart");

    var dataSet = {
        labels: ["Hardware Upgrade", "Application Upgrade", "New Module", "Major Customization"],
        datasets: [{
            label: "Globalpundits",
            backgroundColor: '#004181',
            borderColor: '#004181',
            data: [2, 8, 4, 3],
        },
        {
            label: "Customer",
            backgroundColor: '#FFA300',
            borderColor: '#FFA300',
            data: [6, 24, 14, 8],
        }]
    };

    var myChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: dataSet,
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }],
                xAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
</script>
<script src="js/header.js"></script>
<script src="js/template.js"></script>
</html>