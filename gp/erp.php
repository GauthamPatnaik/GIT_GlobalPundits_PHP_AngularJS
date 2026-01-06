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
            <h1 class="acc-color">Enterprise Professional Services</h1>
            <br>
            <div class="row justify-content-center align-items-top">
                <div class="col-lg">
                    <p>
                        We leverage our unique approach with proven tools and methods resulting in predictable, on time, on budget delivery for ERP solutions. We integrate talent, experience and methodology to ensure a structured and successful engagement.
                        <br>
                        With full life-cycle services ranging from strategy through support, Globalpundits provides services that enable clients to successfully Plan, Implement, Customize, Manage, and Operate their Oracle environment.
                    </p>
                </div>
                <div class="col-lg-2">
                    <img src="images/eps.png" alt="Enterprise Professional Services" class="">
                </div>
            </div>
            <hr>
            <div class="row justify-content-center">
                <div class="col-lg">
                    <h3 class="acc-color">Value Proposition</h3>
                    <p>
                        Globalpundits is a full-service IT Services firm providing Oracle E-Business Suite Professional Services.
                        <br>
                        Our Oracle® and Banner® consultants have significant experience in the industry. This experience coupled with the Globalpundits Enterprise Methodology, GEM, uniquely positions us to partner with you to deliver your ERP solutions, on time, on budget with a superior value proposition.
                    </p>
                </div>
                <div class="col-lg-5">
                    <ul>
                        <h3 class="acc-color">Service offerings include</h3>
                        <li>Oracle E-business Suite Implementation</li>
                        <li>Oracle E-Business Suite and PeopleSoft Upgrades</li>
                        <li>Oracle E-Business Suite and PeopleSoft Upgrades</li>
			<li>Oracle E-business Suite onshore and offshore (Dual Shore) Support</li>
                    </ul>
                    <hr>
                    <img src="images/image.png" alt="Oracle Gold Partner" style="width: 150px; height: auto">
                </div>
            </div>
            <br><br>
        </div>
    </div>
</div>

<div class="container-fluid grad-bg" id="">
    <h1 class="text-center h1-center h1-white">Flexible Solutions that your Enterprise needs</h1>
    <p class="h1-tag text-center">Globalpundits Provides a Total End To End Solution</p>
</div>

<div data-sal="slide-up" data-sal-duration="500" id="" class="container white-bg content-padding">
    <!-- <div class="row align-items-top justify-content-center"> -->

        <div class="row justify-content-around">
            <div class="col-lg-5">
                <h3 class="acc-color">Globalpundits Consultants are unsurpassed solution experts with years of industry experience.</h3>
                <ul>
                    <li>Are real Oracle functional and technical experts with years of hands-on project successes</li>
                    <li>Truly get to know your business and goals to ensure that your solutions meet your needs</li>
                    <li>Have the best tools and training to ensure your project is successful</li>
                    <li>Are professional project and team managers</li>
                    <li>Go the extra mile to ensure projects are delivered on time and on budget</li>
                    <li>Complement your team and culture</li>
                </ul>
            </div>
        
            <div class="col-lg-5">
                <h3 class="acc-color">Our ERP services are spread across multiple streams</h3>
                <ul>
                    <li>Oracle®</li>
                    <li>Banner®</li>
                    <li>Workday®</li>
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