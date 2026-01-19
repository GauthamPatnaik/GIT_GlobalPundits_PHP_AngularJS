<?php
if (isset($_GET['_escaped_fragment_'])) {
  header("Location: https://www.globalpundits.com/gp/careers/#".$_GET['_escaped_fragment_']);
  die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="fragment" content="!">
    <title>GP Careers</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap-grid.min.css">
    <style> <?php include("../css/main.css") ?> </style>
    <style> <?php include("css/careers.css") ?> </style>
    <link rel="stylesheet" type="text/css" href="css/main-mobile.css">
    <link rel="stylesheet" type="text/css" href="css/sal.css">
    <link rel="stylesheet" href="css/bxSlider.css">
    <link rel="stylesheet" href="css/angular-confirm.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.8.5/css/selectize.default.css">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Poppins:700" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
 <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> --> 
<!-- jQuery library --> 
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" ></script> -->
 <!-- Latest compiled JavaScript -->
	 <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>  
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenMax.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parallax/3.1.0/parallax.min.js"></script>
    <script src="js/sal.js"></script>
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.5/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.5/angular-sanitize.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.15/lodash.min.js"></script>
    

    <script src="//unpkg.com/@uirouter/angularjs/release/angular-ui-router.min.js"></script>
    <script src="js/angular-confirm.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-messages/1.7.5/angular-messages.min.js"></script>
    <script src="js/angular-base64-upload.min.js"></script>

    <!-- UI Select files -->
    <script src="js/select.min.js"></script>
    <link rel="stylesheet" href="css/select.min.css">
    
    <script src="js/app.js"></script>

    <script src="js/listingsController.js"></script>
    <script src="js/jobController.js"></script>
    <script src="js/jobAlertController.js"></script>
  
</head>
<body ng-app="gpCareers">

<?php include("/gp/header.html"); ?>

<div id="router">
    <ui-view></ui-view>
</div>    

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<?php include("/gp/footer.html"); ?>
  
</body>
<script> <?php include("../js/header.js") ?> </script>
<script> <?php include("js/index.js") ?> </script>

</html>