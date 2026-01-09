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
    <link rel="stylesheet" href="css/angular-confirm.min.css">

    <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Poppins:700" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenMax.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parallax/3.1.0/parallax.min.js"></script>
    <script src="js/sal.js"></script>
    <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
    <script src="js/anime.min.js"></script>
  
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.5/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-messages/1.7.5/angular-messages.min.js"></script>
    <script src="js/angular-confirm.min.js"></script>

</head>
<body>

<?php
include("header.html");
?>

<!-- content starts here -->
<!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3307.223233188851!2d-81.1737216847493!3d34.012480427271896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88f897f88cf6f98b%3A0x96d526b3f6eb2ca5!2s4715+D+Sunset+Blvd%2C+Lexington%2C+SC+29072%2C+USA!5e0!3m2!1sen!2sin!4v1540415239309" allowfullscreen id="map"></iframe>-->
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3331.134281154544!2d-81.68662268485191!3d33.39366075959458!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88f9ae2f4254df79%3A0x34b032fabb2f65e5!2s927%20Main%20St%2C%20New%20Ellenton%2C%20SC%2029809%2C%20USA!5e0!3m2!1sen!2sin!4v1638276235146!5m2!1sen!2sin" allowfullscreen id="map"></iframe>

<div data-sal="slide-up" data-sal-duration="500" id="s-contact-area" class="container-fluid">
    <div class="row align-items-top">
        <div data-sal="slide-up" data-sal-duration="500" data-sal-delay="100" class="col-lg content-pane">
            <div ng-app="contact" ng-controller="contactController" id="s-content-1" class="container">
                <div class="row justify-content-center align-content-top">
                    <div class="col-lg-10">
                        <h1 class="acc-color">Contact</h1>

                        <div class="row">
                            <div class="col-lg">
                                
                                <h3 class="acc-color">Corporate Office (USA)</h3>
                                <p><strong><i class="material-icons">directions</i></strong>&nbsp; 927 South Main Street | New Ellenton, SC 29809</p>
                                <hr>
                                 <h3 class="acc-color">Corporate Office (INDIA)</h3>                                 
                                <p><strong><i class="material-icons">directions</i></strong>&nbsp; 8th Floor, Plot No. 1-118/1/14/C, DHFLVC Silicon Towers, Kondapur, Hyderabad, Telangana INDIA 500084</p>
                                <hr>
                                 <h3 class="acc-color">Reach Us</h3>
                                <p><strong><i class="material-icons">local_phone</i></strong>&nbsp; (803) 354-9400</p>
                                <p><strong><i class="material-icons">local_printshop</i></strong>&nbsp; (803) 996-1055</p>
                                <p><strong><i class="material-icons">email</i></strong>&nbsp;  info@globalpundits.com</p>
                                <!-- <br><hr><br> -->
                        
                            </div>
                            <div class="col-lg">
                             <br>
                                <h3 class="acc-color">Leave a message</h3>
                                <p class="help_text">We generally are quick repliers, we will get back to you</p>

                                <form name="c_form" ng-submit="submitForm()">
                                  <!-- <label for="contact_name">Your Name</label> -->
                                  <input ng-model="formData.name" name="c_name" type="text"  id="contact_name" placeholder="Your Name" required>
                                  
                                  <div ng-messages="c_form.c_name.$error" ng-show="c_form.c_name.$touched">
                                      <div ng-message="required" class="field-message">This field is required</div>
                                  </div>

                                  <!-- <label for="contact_mail">Your Email ID</label> -->
                                  <input ng-model="formData.mail" name="c_mail" type="email" id="contact_mail"  placeholder="Your Email ID" required>
                                  
                                  <div ng-messages="c_form.c_mail.$error" ng-show="c_form.c_mail.$touched">
                                      <div ng-message="required" class="field-message">This field is required</div>
                                      <div ng-message="email" class="field-message">Not a valid email ID</div>
                                  </div>

                                  <!-- <label for="contact_message">Your Message</label> -->
                                  <textarea ng-model="formData.message" name="c_message"  id="contact_message" rows="10" placeholder="Your Message"  required></textarea>
                                  
                                  <div ng-messages="c_form.c_message.$error" ng-show="c_form.c_message.$touched">
                                      <div ng-message="required" class="field-message">This field is required</div>
                                  </div>

                                  <input type="submit" value="Send" class="button">  
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="col-lg-3 actions-pane">
            
        </div> -->
    </div>
</div>
<!-- content ends here -->

<?php
include("footer.html");
?>
<script>
  var app = angular.module('contact', ['ngMessages', 'cp.ngConfirm']);  
  
  app.controller('contactController', function($scope, $http, $ngConfirm) {
    $scope.formData = {};
     
    $scope.submitForm = function() {
      var sending = $ngConfirm({
          title: 'Sending',
          content: 'Sending your message....',
          type: 'blue',
          backgroundDismiss: true,
          animation: 'top',
          closeAnimation: 'top',
          theme: 'material'
      });
      
      $http({
            method: "POST",
            url: "/contactMail.php",
            data: {
                fields: $scope.formData
            },
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        }).then(function(response) {
            sending.close();
            if (response.data.status) {
                $ngConfirm({
                  title: 'Success',
                  content: response.data.message,
                  type: 'green',
                  backgroundDismiss: true,
                  animation: 'top',
                  closeAnimation: 'top',
                  theme: 'material'
              });
            } else {
                $ngConfirm({
                    title: 'Failed',
                    content: response.data,
                    type: 'red',
                    backgroundDismiss: true,
                    animation: 'top',
                    closeAnimation: 'top',
                    theme: 'material'
                });
            }
        });
    };
    
  });
</script>
  
<!-- <script>
    function initMap() {
    var uluru = {lat: -25.344, lng: 131.036};
    var map = new google.maps.Map(document.getElementById('map'), {zoom: 4, center: uluru});
    var marker = new google.maps.Marker({position: uluru, map: map});
    }
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBwpbLiTOVndA-VSMtqwmWhrY6z1AIsOh0&callback=initMap">
</script> -->

</body>
<script src="js/header.js"></script>
<script src="js/template.js"></script>
</html>