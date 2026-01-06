<?php
include(__DIR__."/../common/db.lib.php");
include(__DIR__."/../common/session.php");
if (!isset($_COOKIE['session_key']) && !isset($_COOKIE['userid'])) {
	echo "<script>";
	echo "window.location.replace('/login.php');";
	echo "</script>";
} else {
	if (!checkSession($_COOKIE['userid'], $_COOKIE['session_key'])) {
		echo "<script>";
		echo "window.location.replace('/login.php');";
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
	<link rel="stylesheet" href="/css/bootstrap.min.css">
    <link href="/css/style.css" rel="stylesheet">
	<link rel="stylesheet" href="/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/notie.min.css">
	
	<script src="/js/jquery-3.2.1.slim.min.js"></script>
	<script src="/js/popper.min.js"></script>
	<script src="/js/tether.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/jquery.timeago.js" type="text/javascript"></script>
	<script src="/js/progressbar.min.js"></script>
	<script src="/js/date.js"></script>
	<script src="/js/animationCounter.min.js"></script>
	<script src="/js/angular.min.js"></script>
 
<script type="text/javascript">
	function prepareDynamicDates() {
	  $('time.loaded').attr("datetime", new Date().toISOString());
	}
	function empStatusTime() {
	  $('#empStatusTime').attr("datetime", new Date().toISOString());
	}

	function getCookie(cname) {
	    var name = cname + "=";
	    var decodedCookie = decodeURIComponent(document.cookie);
	    var ca = decodedCookie.split(';');
	    for(var i = 0; i <ca.length; i++) {
	        var c = ca[i];
	        while (c.charAt(0) == ' ') {
	            c = c.substring(1);
	        }
	        if (c.indexOf(name) == 0) {
	            return c.substring(name.length, c.length);
	        }
	    }
	    return "";
	}
	var userid = getCookie("userid");
	var session_key = getCookie("session_key");
	// alert(session_key);
</script>
<script>
	$(document).ready(function(e) {
		var side_pane_var = 0
		$("#side-pane-button").click(function(){
			if (side_pane_var == 0) {
				$(".side-pane").css('width', '0px');
				$(".side-pane-fixed").css('margin-left', '-220px');
				
				side_pane_var = 1;
			} else {
				$(".side-pane").css('width', '220px');
				$(".side-pane-fixed").css('margin-left', '0px');
				
				side_pane_var = 0;
			}
		});
	});
</script>

</head>

<body>

<?php 
include(__DIR__.'/../topnav.html');
?>

<div class="main-container">
	<?php
	include(__DIR__.'/../sidenav.html');
	?>
	<div class="content-pane">
		<div id="onboarding" ng-app="onboarding" ng-controller="onboardingController" class="container">
			<div class="card rounded-0 border-0">
			  <div class="card-body">
			    <h3 class="text-center">Client Onboarding Documents</h3>
			  </div>
			</div>
			<br>
			<div class="card rounded-0 border-0">
			  <div class="card-body">
			  	<div class="row justify-content-md-center align-items-center">
			  		<div class="col-3">
			  			<div class="form-group">
						    <label for="clientName">Client</label>
						    <select ng-model="clientName" class="form-control" id="clientName">
						      <option value="xylem">Xylem Sensus</option>
						    </select>
						    <small id="clientHelp" class="form-text text-muted">Client's name from Bullhorn</small>
						</div>
					</div>
					<div class="col-3">
			  			<div class="form-group">
						    <label for="candidateID">Candidate ID</label>
						    <input ng-model="candidateID" type="text" class="form-control" id="candidateID" aria-describedby="idHelp">
						    <small id="idHelp" class="form-text text-muted">Bullhorn candidate ID</small>
						</div>
			  		</div>
			  		<div class="col-2">
				  		<button ng-click="onboardSubmit()" type="button" class="btn btn-outline-success">Check</button>
				  	</div>
			  	</div>
			  </div>
			</div>
			
			<br>

			<div ng-show="proccessingTextFlag" id="proccessingText" class="alert alert-primary text-center" role="alert">
				Placeholder
			</div>

		</div> <!-- container-fluid -->
	</div>
</div>
<script src="/js/notie.min.js"></script>
<script type="text/javascript">
	var app1 = angular.module('onboarding', []);
	app1.controller('onboardingController', function($scope, $http) {
		$scope.proccessingTextFlag = false;

		$scope.convertPDF= function(filename,divName) {
			$http({
		      method: "POST",
		      url: "convert_pdf.php",
		      data: {
		      	id: userid,
		      	session_key: session_key,
		      	candidateID: $scope.candidateID,
		      	filename: filename,	
		      	clientName: $scope.clientName,	
		      },
		      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		    }).then(function(response) {
		    	// $scope.editResp = response.data;
		    	console.log(response.data);
		    	$("#"+divName).removeClass('alert-warning');
		    	$("#"+divName).addClass('alert-success');
		    	$("#"+divName).html('Conversion successfull : '+response.data);
		    	$("#"+divName).wrap('<a href="'+$scope.clientName+'/converted/'+response.data+'" target="_blank"></a>');
		    });
		}

		$scope.editTemplate= function() {
			$http({
		      method: "POST",
		      url: $scope.clientName+"/edit_template.php",
		      data: {
		      	id: userid,
		      	session_key: session_key,
		      	candidateID: $scope.candidateID,
		      	c_data: $scope.respData.data	
		      },
		      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		    }).then(function(response) {
		    	$scope.editResp = response.data;
		    	console.log(response.data);

		    	$("#onboarding").append('<div class="card"><div id="filesCard" class="card-body"></div></div>')
		    	$("#filesCard").append('<p>Files - </p>')
		    	for (i=0;i<$scope.editResp.pdf.length;i++) {
		    		$("#filesCard").append('<a href="'+$scope.clientName+'/converted/'+$scope.editResp.pdf[i]+'" target="_blank"><div id="doneFile'+i+'" class="alert alert-success" role="alert">'+$scope.editResp.pdf[i]+'</div></a>');
		    	}

		    	for (i=0;i<$scope.editResp.docx.length;i++) {
		    		$("#filesCard").append('<div id="convFile'+$scope.candidateID+'_'+i+'" class="alert alert-warning" role="alert">Converting '+$scope.editResp.docx[i]+' to PDF...</div>');
		    		$scope.convertPDF($scope.editResp.docx[i], 'convFile'+$scope.candidateID+'_'+i);
		    	}
		    });
		}

	    $scope.fetchCandidate = function() {
	    	$http({
		      method: "POST",
		      url: "bull.php",
		      data: {
		      	id: $scope.candidateID,
		      	feilds: 'name,email,phone'	
		      },
		      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		    }).then(function(response) {
		    	$scope.respData = response.data;
		    	console.log($scope.respData);

		    	if (!$scope.respData.hasOwnProperty('errorMessageKey')) {

		    		$('#proccessingText').html('Success : '+$scope.respData.data.name);
					$('#proccessingText').removeClass('alert-primary');
					$('#proccessingText').removeClass('alert-danger');
					$('#proccessingText').addClass('alert-success');

					$scope.editTemplate();

		    	} else {

		    		if ($scope.respData.errorMessageKey=="errors.badCommand" || $scope.respData.errorMessageKey=="errors.entityNotFound") {
		    			$('#proccessingText').html('Error: Invalid Candidate ID');
						$('#proccessingText').removeClass('alert-primary');
						$('#proccessingText').removeClass('alert-success');
						$('#proccessingText').addClass('alert-danger');
		    		} else {
		    			$('#proccessingText').html('Error: Please refresh the page and try again');
						$('#proccessingText').removeClass('alert-primary');
						$('#proccessingText').removeClass('alert-success');
						$('#proccessingText').addClass('alert-danger');
		    		}

		    	}

		    });
	    };

	    $scope.onboardSubmit = function() {
			if ($scope.clientName != "" && $scope.candidateID) {

				$('#proccessingText').html('Fetching candidate details from Bullhorn...');
				$('#proccessingText').addClass('alert-primary');
				$('#proccessingText').removeClass('alert-success');
				$('#proccessingText').removeClass('alert-danger');

				$scope.proccessingTextFlag = true;
				console.log('sending request...'+$scope.candidateID);
				$scope.fetchCandidate();
			}
		}
	});
	angular.bootstrap(document.getElementById("onboarding"), ['onboarding']);
	$('#sidenav6').addClass('active');
</script>

<script type="text/javascript">
	var app2 = angular.module('rtr', []);
	app2.controller('rtrController', function($scope, $http) {
		$scope.proccessingTextFlag = false;

		$scope.convertPDF= function(filename,divName) {
			$http({
		      method: "POST",
		      url: "convert_pdf.php",
		      data: {
		      	id: userid,
		      	session_key: session_key,
		      	candidateID: $scope.candidateID,
		      	filename: filename,	
		      	clientName: $scope.clientName,	
		      },
		      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		    }).then(function(response) {
		    	// $scope.editResp = response.data;
		    	console.log(response.data);
		    	$("#"+divName).removeClass('alert-warning');
		    	$("#"+divName).addClass('alert-success');
		    	$("#"+divName).html('Conversion successfull : '+response.data);
		    	$("#"+divName).wrap('<a href="'+$scope.clientName+'/converted/'+response.data+'" target="_blank"></a>');
		    });
		}

		$scope.editTemplate= function() {
			$http({
		      method: "POST",
		      url: $scope.clientName+"/edit_template.php",
		      data: {
		      	id: userid,
		      	session_key: session_key,
		      	candidateID: $scope.candidateID,
		      	c_data: $scope.respData.data	
		      },
		      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		    }).then(function(response) {
		    	$scope.editResp = response.data;
		    	console.log(response.data);

		    	$("#onboarding").append('<div class="card"><div id="filesCard" class="card-body"></div></div>')
		    	$("#filesCard").append('<p>Files - </p>')
		    	for (i=0;i<$scope.editResp.pdf.length;i++) {
		    		$("#filesCard").append('<a href="'+$scope.clientName+'/converted/'+$scope.editResp.pdf[i]+'" target="_blank"><div id="doneFile'+i+'" class="alert alert-success" role="alert">'+$scope.editResp.pdf[i]+'</div></a>');
		    	}

		    	for (i=0;i<$scope.editResp.docx.length;i++) {
		    		$("#filesCard").append('<div id="convFile'+$scope.candidateID+'_'+i+'" class="alert alert-warning" role="alert">Converting '+$scope.editResp.docx[i]+' to PDF...</div>');
		    		$scope.convertPDF($scope.editResp.docx[i], 'convFile'+$scope.candidateID+'_'+i);
		    	}
		    });
		}

	    $scope.fetchCandidate = function() {
	    	$http({
		      method: "POST",
		      url: "rtr-bull.php",
		      data: {
		      	id: $scope.candidateID,
		      	feilds: 'name,email,phone'	
		      },
		      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		    }).then(function(response) {
		    	$scope.respData = response.data;
		    	console.log($scope.respData);

		    	if (!$scope.respData.hasOwnProperty('errorMessageKey')) {

		    		$('#proccessingText').html('Success : '+$scope.respData.data.name);
					$('#proccessingText').removeClass('alert-primary');
					$('#proccessingText').removeClass('alert-danger');
					$('#proccessingText').addClass('alert-success');

					$scope.editTemplate();

		    	} else {

		    		if ($scope.respData.errorMessageKey=="errors.badCommand" || $scope.respData.errorMessageKey=="errors.entityNotFound") {
		    			$('#proccessingText').html('Error: Invalid Candidate ID');
						$('#proccessingText').removeClass('alert-primary');
						$('#proccessingText').removeClass('alert-success');
						$('#proccessingText').addClass('alert-danger');
		    		} else {
		    			$('#proccessingText').html('Error: Please refresh the page and try again');
						$('#proccessingText').removeClass('alert-primary');
						$('#proccessingText').removeClass('alert-success');
						$('#proccessingText').addClass('alert-danger');
		    		}

		    	}

		    });
	    };

	    $scope.onboardSubmit = function() {
			if ($scope.clientName != "" && $scope.candidateID) {

				$('#proccessingText').html('Fetching candidate details from Bullhorn...');
				$('#proccessingText').addClass('alert-primary');
				$('#proccessingText').removeClass('alert-success');
				$('#proccessingText').removeClass('alert-danger');

				$scope.proccessingTextFlag = true;
				console.log('sending request...'+$scope.candidateID);
				$scope.fetchCandidate();
			}
		}
	});
	angular.bootstrap(document.getElementById("onboarding"), ['onboarding']);
	$('#sidenav6').addClass('active');
</script>
</body>
</html>
