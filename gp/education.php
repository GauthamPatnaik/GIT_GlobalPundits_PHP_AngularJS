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
            <h1 class="acc-color">Higher Education Services</h1>
            <br>
            <div class="row">
                <div class="col-lg">
                    <p>
                        Higher education institutions face an ever changing and evolving technology landscape. Globalpundits understands these challenges which is why we have a focused, dedicated ERP practice to serve our higher education clients. With extensive and proven expertise with Oracle®, Banner® and Colleague® for Higher Education, Globalpundits is uniquely qualified to partner with you for your ERP implementation, upgrades and support needs.
                        <br>
                        Our Oracle®, Banner® and Colleague® consultants have significant experience in the Higher Education industry. This experience coupled with the Globalpundits Enterprise Methodology, GEM, uniquely positions us to partner with you to deliver your ERP solutions, on time, on budget with a superior value proposition.
                    </p>
                </div>
            </div>
            <br><br>
        </div>
    </div>
</div>

<div class="container-fluid grad-bg" id="">
    <h1 class="text-center h1-center h1-white">Flexible Solutions for Higher Education Institutions</h1>
    <p class="h1-tag text-center">Globalpundits Provides a Total End To End Solution</p>
</div>

<div data-sal="slide-up" data-sal-duration="500" id="" class="container white-bg content-padding">
    <!-- <div class="row align-items-top justify-content-center"> -->

        <div class="row justify-content-around">
            <div class="col-lg-5">
                <h3 class="acc-color">Enterprise Professional Services specific to Higher Education</h3>
                <ul>
                    <li>Oracle®</li>
                    <li>Banner®</li>
                    <li>Colleague®</li>
                    <li>Workday®</li>
                </ul>
            </div>

            <div class="col-lg-5">
                <h3 class="acc-color">Enterprise Managed Services specific to Higher Education</h3>
                <ul>
                    <li>Application Support</li>
                    <li>Database Administration</li>
                    <li>Patch Management</li>
                    <li>Upgrades</li>
                </ul>
            </div>
        </div>
        
        <div class="col-lg-10">
            <br><br><br>
            <div class="s-emp-block">
                <h3 class="acc-color h3-center">For our clients, who we are is reflected in a differentiating value proposition:</h3>
                <ul>
                    <li>Full life-cycle services from strategy through managed services</li>
                    <li>Extraordinary consulting talent and expertise</li>
                    <li>Global reach and off-shore capabilities</li>
                    <li>Standard project execution and quality</li>
                </ul>
            </div>
            <br>
        </div>
        
    <!-- </div> -->
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