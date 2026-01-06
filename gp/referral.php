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
<!-- <div data-sal="slide-up" data-sal-duration="500" id="top-space"></div> -->
<div data-sal="slide-up" data-sal-duration="500" id="s-content-area" class="container-fluid">
    <div class="row align-items-top">
    
        <div data-sal="slide-up" data-sal-duration="500" data-sal-delay="100" class="col-lg-9 content-pane">
            <div id="s-content-1" class="container">
           <div>
           
                           
           </div>
                <div class="row justify-content-center align-content-top">
                    <div  class="col-lg-12">
                    <img src="images/Referral-program.jpg" alt="Referral"  > 
                    <!-- <h3 class="acc-color">Referral Program</h3>                  -->
                        <p class="justifyclass">
                            <span class="firstletter">D</span>id you know that referrals are one of the best methods to get a job! We hope that you will take the time to refer someone you know that can use our help in finding their next job. Globalpundits will be happy to reward you for recommending Globalpundits to people you know. 
                            <br>
                            <span class="firstletter">I</span>f you refer someone and they are placed in a job within 12 months with Globalpundits we will reward you with a referral bonus of $500 to $2,000 depending upon the level and length of assignment. To submit a candidate, please use the Referral Rewards form below. This ensures that we get the information we need to contact your candidate, and that you receive credit for your referral, in the event a placement is made. You will be sent information to track the status of your referral. 
                            <br>
                            <span class="firstletter">T</span>he Referral Program is available to both current employees and candidates of Globalpundits.
                        </p>                                                
                       <hr class="col-sm-6 blu"> 
                       
                    </div>
                    <div ng-app="referrals" ng-controller="referralController" class="col-lg-10">
                        <span ng-hide="message==''" ng-class="alertClass" class="alert-block">{{ message }}</span>
                        <br>
                        <form name="referralForm" ng-submit="submitForm()">
                            <div class="row">
                                <div class="col-lg">
                                    <!-- <label for="r_name">Your name</label> -->
                                    <input ng-model="formData.r_name" type="text" name="r_name" required placeholder="Your name" />

                                    <div ng-messages="referralForm.r_name.$error" ng-show="referralForm.r_name.$touched">
                                        <div ng-message="required" class="field-message">This field is required</div>
                                    </div>

                                    <!-- <label for="r_mail">Your email ID</label> -->
                                    <input ng-model="formData.r_mail" type="email" name="r_mail" placeholder="Your email ID" required />

                                     <div ng-messages="referralForm.r_mail.$error" ng-show="referralForm.r_mail.$touched">
                                        <div ng-message="required" class="field-message">This field is required</div>
                                        <div ng-message="email" class="field-message">Not a valid email ID</div>
                                    </div>

                                    <!-- <label for="r_phn">Your phone number</label> -->
                                    <input ng-model="formData.r_phn" type="text" name="r_phn"  placeholder="Your phone number"
                                        ng-pattern="/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/"
                                    required />
                                    <div ng-messages="referralForm.r_phn.$error" ng-show="referralForm.r_phn.$touched">
                                        <div ng-message="required" class="field-message">This field is required</div>
                                        <div ng-message="pattern" class="field-message">Must be a valid 10 digit phone number</div>
                                    </div>

                                </div>
                                <div class="col-lg">
                                    <!-- <label for="c_name">Referral's name</label> -->
                                    <input ng-model="formData.c_name" type="text" name="c_name" placeholder="Referral's name" required />

                                    <div ng-messages="referralForm.c_name.$error" ng-show="referralForm.c_name.$touched">
                                        <div ng-message="required" class="field-message">This field is required</div>
                                    </div>

                                    <!-- <label for="c_mail">Referral's email ID</label> -->
                                    <input ng-model="formData.c_mail" type="email" name="c_mail" placeholder="Referral's email ID" required />

                                    <div ng-messages="referralForm.c_mail.$error" ng-show="referralForm.c_mail.$touched">
                                        <div ng-message="required" class="field-message">This field is required</div>
                                        <div ng-message="email" class="field-message">Not a valid email ID</div>
                                    </div>

                                    <!-- <label for="c_phn">Referral's phone number</label> -->
                                    <input ng-model="formData.c_phn" type="text" name="c_phn" placeholder="Referral's phone number"
                                        ng-pattern="/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/"
                                    required />

                                    <div ng-messages="referralForm.c_phn.$error" ng-show="referralForm.c_phn.$touched">
                                        <div ng-message="required" class="field-message">This field is required</div>
                                        <div ng-message="pattern" class="field-message">Must be a valid 10 digit phone number</div>
                                    </div>
                                </div>
                            </div>
                            <p class="help_text">By submitting the above data you accept our <a ng-click="showTerms()">terms and conditions</a> of this program</p>
                            <input type="submit" value="Submit" class="button" ng-disabled="disableBtn">
                            
                        </form>
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
<script src="js/referralController.js"></script>
</html>