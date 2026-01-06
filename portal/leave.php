<?php
include("common/db.lib.php");
include("common/session.php");
if (!isset($_COOKIE['session_key']) && !isset($_COOKIE['userid'])) {
	echo "<script>";
	echo "window.location.replace('login.php');";
	echo "</script>";
} else {
	if (!checkSession($_COOKIE['userid'], $_COOKIE['session_key'])) {
		echo "<script>";
		echo "window.location.replace('login.php');";
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
    <link href="css/style.css" rel="stylesheet">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/notie.min.css">
	<link rel="stylesheet" type="text/css" href="css/datedropper.min.css">
	<link rel="stylesheet" type="text/css" href="css/genAtt-date-theme.css">
 
	<script src="js/jquery-3.2.1.slim.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/tether.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/date.js"></script>
	<script src="js/angular.min.js"></script>
	<script src="js/datedropper.min.js"></script>
 
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
include('topnav.html');
?>

<div class="main-container">
	<?php
	include('sidenav.html');
	?>
	<div class="content-pane">
		<div  id="leaveBody" ng-app="leaveBody" ng-controller="leaveBodyController"  class="container">
			<div class="row justify-content-between">
				<div class="col">
					<div class="row">
						<div class="col card rounded-0 left-right-margin bg-primary text-light">
							<div class="card-body text-center">
								<h1 class="display-2">10</h1>
								<hr>
								<p>Leaves available</p>
							</div>
						</div>
						<div class="col card rounded-0 left-right-margin bg-success text-light">
							<div class="card-body text-center">
								<h1 class="display-2">2</h1>
								<hr>
								<p>Leaves availed</p>
							</div>
						</div>
						<div class="col card rounded-0 left-right-margin bg-warning text-light">
							<div class="card-body text-center">
								<h1 class="display-2">4</h1>
								<hr>
								<p>SU this month</p>
							</div>
						</div>
						<div class="col card rounded-0 left-right-margin bg-danger text-light">
							<div class="card-body text-center">
								<h1 class="display-2">1</h1>
								<hr>
								<p>Absent(s) this month</p>
							</div>
						</div>
					</div>
				</div>
				
			</div>	
			<hr>
			<div class="row justify-content-around">
				<div class="col-9">

					<div class="card rounded-0">
						<div class="card-body">
							<nav class="nav">
							  <a id="planLeaveButton" ng-click="showPlanLeave()" class="nav-link" href="#">Plan/Apply Leave</a>
							  <a id="cancelLeaveButton" ng-click="showCancelLeave()" class="nav-link" href="#">Cancel Leave</a>
							</nav>

							<!-- Plan leave part -->
							<span ng-show="planLeaveFlag">
							<hr>

							<div class="alert alert-info" role="alert">
								<br>
								<h4 class="text-center"><strong>Plan/Apply Leave</strong></h4>
								<hr>
								<dl class="row">
								  <dt class="col-sm-3">Future date leaves</dt>
								  <dd class="col-sm-9">Future date leaves can be applied only for 1 month in advance from current date</dd>

								  <dt class="col-sm-3">Past date leaves</dt>
								  <dd class="col-sm-9">Past date leaves can be applied only for last 10 days from current date</dd>
								</dl>
							</div>
							<div id="planLeaveAlert" ng-show="planLeaveAlertFlag" class="alert alert-danger text-center" role="alert">
							  
							</div>
							<div ng-show="planLeaveOneFlag" class="row justify-content-center">
								<div class="col-4">
									<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1">From</span>
									  <input ng-model="leaveFromDate" id="leaveFrom" type="text" class="form-control" placeholder="From date" aria-label="" aria-describedby="basic-addon1"
									   data-format="Y-m-d" data-large-mode="true" data-min-year="2017" data-modal="true" data-large-default="true" data-theme="genAtt-date-theme">
									</div>
								</div>
								<div class="col-4">
									<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1">To</span>
									  <input ng-model="leaveToDate" id="leaveTo" type="text" class="form-control" placeholder="To date" aria-label="" aria-describedby="basic-addon1"
									  data-format="Y-m-d" data-large-mode="true" data-min-year="2017" data-modal="true" data-large-default="true" data-theme="genAtt-date-theme">
									</div>
								</div>
								<div class="col-2">
									<button id="planLeaveSubmitButton" ng-click="planLeaveSubmit()" type="button" class="btn btn-outline-success">Check</button>
								</div>
							</div>
							<span ng-show="planLeaveTwoFlag">
							<hr>
							<div class="row justify-content-center">
								<div class="col-10 text-center">
									<p>Applying leave for <b id="workingDaysText">10</b> working day(s)</p>
								</div>
							</div>
							<div class="row justify-content-center">
								<div class="col-7">
									<label for="exampleFormControlTextarea1">Reason -</label>
    								<textarea class="form-control" id="leaveReason" rows="3"></textarea>
								</div>
								<div class="col-3 align-self-center">
									<button ng-click="planLeaveSubmit()" type="button" class="btn btn-outline-success">Apply</button>
									<button ng-click="resetPage()" type="button" class="btn btn-outline-primary">Reset</button>
								</div>
							</div>
							<br>
							</span>
							</span>
							<!-- Plan leave part end -->

							<!-- cancel leave part-->
							<span ng-show="cancelLeaveFlag">
							<hr>
							<div class="alert alert-info" role="alert">
								<br>
								<h4 class="text-center"><strong>Cancel Leave</strong></h4>
								<hr>
								<dl class="row">
								  <dt class="col-sm-3">Cancel approved leaves</dt>
								  <dd class="col-sm-9">Pre approved leaves will be cancelled only after cancellation approval from respective manager</dd>

								  <dt class="col-sm-3">Cancel approval pending leaves</dt>
								  <dd class="col-sm-9">Pending leaves will be marked as cancelled immediatly and do not require cancellation approval from respective manager</dd>
								</dl>
							</div>
							<br>
							<div class="row justify-content-center">
								<div class="card col-11 rounded-0">
									<div class="card-body">
										
									</div>
								</div>
								<div class="card col-11 rounded-0">
									<div class="card-body">
										
									</div>
								</div>
							</div>
							<br>
							</span>
							<!-- cancel leave part-->

						</div>
					</div>
					<br>
					<div class="card rounded-0 border-0">
						<div class="card-header text-center">
							Leaves history
						</div>
				    	<table class="table table-hover">
						  <thead class="table-inverse">
						    <tr>
						      <th>From</th>
						      <th>To</th>
						      <th>Reason</th>
						      <th>Status</th>
						    </tr>
						  </thead>
						  <tbody>
						    <tr>
						      <td>21 December</td>
						      <td>27 December</td>
						      <td>Out of station</td>
						      <td><strong>Pending</strong></td>
						    </tr>
						  </tbody>
						</table>
					</div>
				</div>
				<div class="col-3 rounded-0">
					<ul class="list-group rounded-0 shadow-1">
					  <li class="list-group-item active">Holiday Calendar</li>
					  <li class="list-group-item">Dapibus ac facilisis in</li>
					  <li class="list-group-item">Morbi leo risus</li>
					  <li class="list-group-item">Porta ac consectetur ac</li>
					  <li class="list-group-item">Vestibulum at eros</li>
					</ul>
				</div>
			</div>
		</div> <!-- container-fluid -->
	</div>
</div>
<script src="js/notie.min.js"></script>
<script type="text/javascript">

	function workingDays(from_dt, to_dt) {
		var from = Date.parse(from_dt).addDays(-1);
		var to = Date.parse(to_dt);

		var workingDays = 0;
		var totalDays = 0;
		var days = [];

		while(!from.equals(to)) {
			from = from.addDays(1);
			
			totalDays += 1;
			if (!from.is().sat() && !from.is().sun()) {
				workingDays += 1;
			}
		}

		days[0] = totalDays;
		days[1] = workingDays;
		
		return days;
	} 

	function checkDates(from, to) {
		from = Date.parse(from);
		to = Date.parse(to);

		if (from.compareTo(to) == 1) {
			return false;
		}
		return true;
	}

	function checkPast(from) {
		from = Date.parse(from);

		pastDate = Date.parse('today').addDays(-10);

		if (from.compareTo(pastDate) == -1) {
			return false;
		}
		return true;
	}

	function checkFuture(to) {
		to = Date.parse(to);

		futureDate = Date.parse('today').addDays(30);

		if (to.compareTo(futureDate) == 1) {
			return false;
		}
		return true;
	}

	$('#leaveFrom').dateDropper();
	$('#leaveTo').dateDropper();

	// notie.confirm({ type: 1, text: 'Mark attendance?', stay: true, position: 'bottom' })
	var app1 = angular.module('leaveBody', []);
	app1.controller('leaveBodyController', function($scope, $http) {
		$scope.planLeaveFlag = false;
		$scope.cancelLeaveFlag = false;
		
		$scope.planLeaveOneFlag = true;
		$scope.planLeaveTwoFlag = false;
		$scope.planLeaveAlertFlag = false;

		// $scope.leaveFromDate;
		// $scope.leaveToDate;

		$scope.planLeaveSubmit = function() {
			if (!checkDates($scope.leaveFromDate, $scope.leaveToDate)) {
				$scope.planLeaveAlertFlag = true;
				$scope.planLeaveTwoFlag = false;
				$scope.planLeaveOneFlag = true;

				$('#planLeaveAlert').html("From date greater than to date");
			} else if (!checkPast($scope.leaveFromDate)) {
				$scope.planLeaveAlertFlag = true;
				$scope.planLeaveTwoFlag = false;
				$scope.planLeaveOneFlag = true;
				
				$('#planLeaveAlert').html("Cannot apply for leaves older that 10 days from today");
			} else if (!checkFuture($scope.leaveToDate)) {
				$scope.planLeaveAlertFlag = true;
				$scope.planLeaveTwoFlag = false;
				$scope.planLeaveOneFlag = true;
				
				$('#planLeaveAlert').html("Cannot plan for leaves for more than 30 days from today");
			} else {
				wDays = workingDays($scope.leaveFromDate, $scope.leaveToDate);
				
				if (wDays[1]>5) {
					$scope.planLeaveAlertFlag = true;
					$scope.planLeaveTwoFlag = false;
					$scope.planLeaveOneFlag = true;
					
					$('#planLeaveAlert').html("Cannot apply for leaves for more than 5 working days at once");
				} else {
					$scope.planLeaveTwoFlag = true;
					$scope.planLeaveAlertFlag = false;
					$scope.planLeaveOneFlag = false;

					$('#workingDaysText').html(wDays[1]);
				}
			}

		}

		$scope.showPlanLeave = function() {
			$scope.planLeaveFlag = true;
			$scope.cancelLeaveFlag = false;
			$("#planLeaveButton").addClass("text-primary");
			$("#planLeaveButton").removeClass("text-secondary");

			$("#cancelLeaveButton").addClass("text-secondary");
			$("#cancelLeaveButton").removeClass("text-primary");
		}

		$scope.resetPage = function() {
			location.reload();
		}

		$scope.showCancelLeave = function() {
			$scope.planLeaveFlag = false;
			$scope.cancelLeaveFlag = true;
			$("#cancelLeaveButton").addClass("text-primary");
			$("#cancelLeaveButton").removeClass("text-secondary");
			
			$("#planLeaveButton").addClass("text-secondary");
			$("#planLeaveButton").removeClass("text-primary");
		}

	});
	angular.bootstrap(document.getElementById("leaveBody"), ['leaveBody']);
	$('#sidenav4').addClass('active');

</script>
</body>
</html>
