<?php
include("common/db.lib.php");
include("common/session.php");
if (isset($_COOKIE['session_key']) && isset($_COOKIE['userid'])) {
        if (checkSession($_COOKIE['userid'], $_COOKIE['session_key'])) {
            echo "<script>";
	          echo "window.location.replace('index.php#!/Dashboard');";
	          echo "</script>";
        }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    

    <title>GP Portal</title>

    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/login.css" rel="stylesheet">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/tether.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/progressbar.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
	
	<meta name="google-signin-client_id" content="1067019098654-9v3qri5u07rhjo9c8a6jpea24ecf19vk.apps.googleusercontent.com">
  
<script>
	$(document).ready(function(e) {
		$("#errorMsg").hide();
		$("#login-card").css('margin-top', '80px');
		$("#login-card").css('opacity', '1');
	});

	function onSignIn(googleUser) {
	  var profile = googleUser.getBasicProfile();
	  var id_token = googleUser.getAuthResponse().id_token;

	  $.ajax({
	    url: 'common/login_redir.php',
	    type: 'post',
	    data: {
	        id_token: id_token,
	        type: 'Google'
	    },
	    headers: {
	        "Content-Type": 'application/x-www-form-urlencoded'
	    },
	    success: function (data) {
	        console.info(data);
	        if (data == "index.php") {
	        	window.location.replace('index.php#!/Dashboard');
	        } 
	        else if (data == "Use your GP email account to login via Google sign in or use GP Portal credentials below to continue") {
	        	var auth2 = gapi.auth2.getAuthInstance();
			    auth2.signOut();
			    $("#errorMsg").show();
	        	$("#errorMsg").html(data);
	        } else {
	        	$("#errorMsg").show();
	        	$("#errorMsg").html(data);
	        }
	    }
	  });
	}
	
</script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
</head>

<body>
<div class="container">
	<div class="row justify-content-md-center align-items-center">
		<div ng-app="loginApp" ng-controller="loginAppController" id="login-card" class="col-md-5 card card-middle rounded-0 border-0">
			<img class="card-logo" src="images/logo_2.png" alt="">
			<div class="card-body">
				<div id="login-loader"></div>
				<br>
				<div id="errorMsg" class="alert alert-danger" role="alert">
				  
				</div>
				<div class="input-group" id="username">
				  <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user-circle-o" aria-hidden="true"></i></span>
				  <input ng-model="username" type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
				</div>
				<br>
				<div class="input-group" id="password">
				  <span class="input-group-addon" id="basic-addon2"><i class="fa fa-key" aria-hidden="true"></i></span>
				  <input ng-model="password" type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon2">
				</div>
				<br>

				<div class="row justify-content-center">
					<div class="col-lg-4 text-center">
						<div class="g-signin2" data-onsuccess="onSignIn" data-prompt="select_account"></div>
					</div>
					<div class="col-lg-5">
						<button ng-click="go()" id="login-btn" type="submit" onclick="loadtheloader()" class="btn btn-outline-primary btn-block">Login</button>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var line = new ProgressBar.Line('#login-loader', {
	  strokeWidth: 0.5,
	  easing: 'easeInOut',
	  duration: 1400,
	  color: '#0275d8',
	  trailColor: '#eee',
	  trailWidth: 0.3,
	  svgStyle: null
	});

	var app = angular.module('loginApp', []);
	app.controller('loginAppController', function($scope, $http) {
		$scope.password = '';
		$scope.username = '';
	  $scope.go = function() {
	  	$('#username').removeClass('invalid');
	  	$('#password').removeClass('invalid');
	    $http({
	      method: "POST",
	      url: "common/login_redir.php",
	      data: {
	      	id: $scope.username,
	      	password: $scope.password,
	      	type: 'GP'
	      },
	      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	    }).then(function(response) {
	      line.animate(1);
	      $scope.myWelcome = response.data;
	      if (response.data['status'] == '11') {
	      	window.location.replace(response.data['message']);
	      } 
	      else if (response.data['status'] == '10') {
	      	$('#username').addClass('invalid');
	      	$("#errorMsg").show();
	        $("#errorMsg").html(response.data.message);
	      } else {
	      	$('#password').addClass('invalid');
	      	$("#errorMsg").show();
	        $("#errorMsg").html(response.data.message);
	      }
	      console.log($scope.myWelcome);
	    });
	  }
	});
</script>
<script>
<!-- var ProgressBar = require('progressbar.js') -->

function loadtheloader() {
	line.animate(.6);
}
</script>

</body>
</html>
