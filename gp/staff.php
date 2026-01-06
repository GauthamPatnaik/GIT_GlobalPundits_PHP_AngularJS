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
            <h1 class="acc-color">Technical & Professional Staff Augmentation</h1>
            <br>
            <div class="row justify-content-center align-items-top">
                <div class="col-lg">
                    <p>
                        Globalpundits, Inc. specializes in providing expert-level Information Technology, Engineering and other technical resources to augment our clients' staffing needs. These resources are engaged quickly and at a competitive rate to enable our clients to complete critical projects on time and under budget. Our engaged employees and consultants have an average of eighteen years of experience, and are typically on assignment for twelve to twenty- four months
                        <br>
                        Globalpundits delivers the expertise and experience of a large company with the speed, flexibility service of a small, minority owned, business. For over a decade, we have guided clients through the challenges of identifying, attracting, engaging, and retaining critical talent.
                    </p>
                </div>
                <div class="col-lg-2">
                    <img src="images/staff.png" alt="Enterprise Professional Services" class="">
                </div>
            </div>
            <hr>
            <div class="row justify-content-center">
                <div class="col-lg">
                    <h3 class="acc-color">Value Proposition</h3>
                    <p>
                    Globalpundits’ clients include both large and small organizations to include a world leader in aerospace manufacturing, two of the nation’s largest engineering firms, a leading provider of health insurance, a Fortune 20 global services & software technology company, State Government agencies, two Fortune 500 utilities, multiple Nuclear operating & services companies, and multiple property and casualty insurance technology companies
                    </p>
                </div>
                <div class="col-lg-5">
                    <ul>
                        <h3 class="acc-color">Globalpundits is a premier provider to clients in every field</h3>
                        <li>Aerospace</li>
                        <li>Nuclear</li>
                        <li>Information Technology</li>
                        <li>Engineering</li>
                        <li>Public Sector</li>
                        <li>Government Sector</li>
                    </ul>
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
            <div class="col-lg-10">
                <h3 class="acc-color">Globalpundits Consultants are unsurpassed talent providers with years of industry experience.</h3>
                <ul>
                    <li>We are a tier one national supplier of IT, Engineering and Technical resources to one of the world’s largest aerospace manufacturers</li>
                    <li>We have more than five years’ experience supplying technical talent in the DOE and commercial nuclear space</li>
                    <li>We are premier provider of information technology talent to support our clients’ critical IT resource needs</li>
                    <li>We have a successful track record of attracting and engaging critical technical talent to help your engineering needs</li>
                    <li>Globalpundits has been a key IT staff augmentation supplier to local governments and universities/colleges</li>
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