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
	<link rel="stylesheet" type="text/css" href="css/vis.min.css">
	
	<script src="js/jquery-3.2.1.slim.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/tether.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.timeago.js" type="text/javascript"></script>
	<script src="js/progressbar.min.js"></script>
	<script src="js/date.js"></script>
	<script src="js/animationCounter.min.js"></script>
	<script src="js/angular.min.js"></script>
	<script src="js/vis.min.js"></script>

 
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
<script>
	var day = Date.today().toString('dd');
	var month = Date.today().toString('MMMM');
	
	
	<!-- alert(Date.getDaysInMonth(Date.today().toString('yyyy'), Date.today().toString('M')) ); -->
	
	$(document).ready(function(e) {
		$('#card_day').text(day);
		$('#card_month').text(month);
		$('#card_month1').text(month);
		
		$('.count').animationCounter({
		  start: 0,
		  end: day,
		  delay: 1000/day,
		  txt: Date.today().toString('S')
		});

	});
</script>

<script type="text/javascript">
	var workingDays = 0;
	var workingDaysNow = 0;
	var daysInMonth = Date.getDaysInMonth(Date.today().toString('yyyy'), Date.today().toString('M')-1);
	// alert(Date.getDaysInMonth(Date.today().toString('yyyy'), Date.today().toString('M')));
	for (var i=0;i<daysInMonth;i++) {
		if (Date.today().moveToFirstDayOfMonth().add({ days: i+1}).is().weekday())  {
			workingDays = workingDays + 1;
		} 
	}
	for (var i=0;i<Date.today().toString('dd');i++) {
		if (Date.today().moveToFirstDayOfMonth().add({ days: i+1}).is().weekday())  {
			workingDaysNow = workingDaysNow + 1;
		} 
	}
	// alert(workingDaysNow+'/'+workingDays);
	$(document).ready(function(e) {
		$('.count2-1').animationCounter({
		  start: 0,
		  end: workingDaysNow,
		  delay: 1000/workingDaysNow
		});
		$('.count2-2').animationCounter({
		  start: 0,
		  end: workingDays,
		  delay: 1000/workingDays
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
	<div id="content-area" class="content-pane">
		<div class="container">
			
			<div class="alert alert-primary" role="alert">
			  <strong>Welcome</strong> <span id="displayMessage">cName</span>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
			
			<div class="card-deck">
				<div class="card rounded-0 border-0">
					<div class="centering card-blue">
						<div id="card1" class="radial-blocks">
							<div class="radial-inner">
								<h2 class="count">18</h2>
								<h3 id="card_month1">Month</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="card rounded-0 border-0">
					<div class="card-blue centering">
						<div id="card2" class="radial-blocks">
							<div class="radial-inner">
								<h2><span class="count2-1">0</span>/<span class="count2-2">0</span></h2>
								<h3 id="">Working days</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="card rounded-0 border-0">
					<div class="card-blue centering">
						<div id="card3" class="radial-blocks">
							<div class="radial-inner">
								<h2 class="count">18</h2>
								<h3 id="">Nov</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="card rounded-0 border-0">
					<div ng-app="dashAttStatus" ng-controller="dashAttStatusLoader" id="att_card" class="att-in centering">
						<div id="card4" class="radial-blocks">
							<div class="radial-inner">
								<h2 ng-if="status == 'IN'" class="">IN</h2>
								<h2 ng-if="status == 'OUT'" class="">OUT</h2>
								<h2 ng-if="status == 'Status unknown'" class="">SU</h2>
								<h2 ng-if="status == 'Leave'" class="">Leave</h2>
								<h3 id="">Attendance</h2>
							</div>
						</div>
					</div>
					<script type="text/javascript">
						var att_status = "";
						var att_color = "";


						var app1 = angular.module('dashAttStatus', []);
						app1.controller('dashAttStatusLoader', function($scope, $http) {
							$http({
						      method: "POST",
						      url: "app/dashboardAttStatus.php",
						      data: {
						      	id: userid,
						      	session_key: session_key	
						      },
						      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
						    }).then(function(response) {
						      $scope.respData = response.data;
						      $scope.status = $scope.respData.status;
						      att_status = $scope.respData.status;
						      if (att_status == 'IN') {
						      		att_color = '#00932c';
						      } 
						      else if (att_status == 'OUT') {
						      		att_color = '#007E33';
						      } else if (att_status == 'Leave') {
						      		att_color = '#4cdbff';
						      } else {
						        	att_color = '#ffbb33';
						      }

						      var line3 = new ProgressBar.Circle('#card4', {
								  strokeWidth: 6,
								  easing: 'easeInOut',
								  duration: 1400,
								  color: att_color,
								  trailColor: '#eee',
								  trailWidth: 5,
								  svgStyle: null
								});

						      line3.animate(1);
						      // alert(att_color);
						      console.log($scope.respData);
						  });
						});
						app1.filter('capitalize', function() {
						    return function(input) {
						      return (!!input) ? input.charAt(0).toUpperCase() + input.substr(1).toLowerCase() : '';
						    }
						});
						angular.bootstrap(document.getElementById("att_card"), ['dashAttStatus']);
					</script>	
				</div>
			</div>
			<hr>
			<!-- <div class="container-fluid"> -->
			<div class="">
				<div class="card border-0 rounded-0">
					<div class="card-header text-center">Timeline</div>
					<div class="card-body">
						<div id="timeline"></div>
					</div>
				</div>
			</div>
			<br>
			<script type="text/javascript">
			  // DOM element where the Timeline will be attached
			  // var container = document.getElementById('timeline');

			  // Create a DataSet (allows two way data-binding)
			  var items = new vis.DataSet([
			    {id: 1, content: '2013-04-20', start: '2013-04-20 09:00:00', end: '2013-04-20 20:00:00', title: '<b>Name : </b>Mohammed Ashfaque'},
			    {id: 2, content: '2013-04-20', start: '2013-04-20 10:00:00', title: '<b>Name : </b>Mohammed Atif'},
			    {id: 3, content: '2013-04-21', start: '2013-04-21 09:00:00', end: '2013-04-21 20:30:00',},
			    {id: 4, content: '2013-04-22', start: '2013-04-22 09:00:00', end: '2013-04-22 18:45:00',},
			    {id: 5, content: '2013-04-23', start: '2013-04-23 09:00:00', end: '2013-04-23 21:49:00',},
			  ]);
			  
			  var arr = [];
			  for (var i=0;i<5;i++) {
			  	arr[i] = {content: '2013-04-2'+i, start: '2013-04-2'+i+' 09:00:00', end: '2013-04-2'+i+' 20:00:00', title: '<b>Name : </b>Mohammed Ashfaque'};
			  }
			</script>

					<div class="row justify-content-between">
					    <div ng-app="dashAttRecords" ng-controller="dashAttRecordsLoader" id="att_record" class="col-md-8">
					    	<div class="card rounded-0 border-0">
					    	<table class="table table-hover">
							  <thead class="table-inverse">
							    <tr>
							      <th>#</th>
							      <th>ID</th>
							      <th>Date In</th>
							      <th>In</th>
							      <th>Date Out</th>
							      <th>Out</th>
							      <th>Status</th>
							    </tr>
							  </thead>
							  <tbody>
							    <tr ng-repeat="x in respData">
							      <th scope="row">{{ $index+1 }}</th>
							      <td>{{ x.ID }}</td>
							      <td>{{ x.date_in }}</td>
							      <td>{{ x.att_in }}</td>
							      <td>{{ x.date_out }}</td>
							      <td>{{ x.att_out }}</td>
							      <td ng-if=" x.status == 'Present' " class="text-success"><strong>{{ x.status }}</strong></td>
							      <td ng-if=" x.status == 'Absent' " class="text-danger"><strong>{{ x.status }}</strong></td>
							      <td ng-if=" x.status == 'Status unknown' " class="text-warning"><strong>{{ x.status }}</strong></td>
							      <td ng-if=" x.status == 'Leave' " class="text-primary"><strong>{{ x.status }}</strong></td>
							    </tr>
							  </tbody>
							</table>
							<p  class="text-center small text-secondary">updated <time id="dash_att_time" class="timeago loaded">update time</time></p>
							</div>
					    </div>
					    <!-- Att records angularjs module -->
					    <script>
							var app1 = angular.module('dashAttRecords', []);
							app1.controller('dashAttRecordsLoader', function($scope, $http) {
								$http({
							      method: "POST",
							      url: "app/dashAttRecords.php",
							      data: {
							      	id: userid,
							      	session_key: session_key	
							      },
							      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
							    }).then(function(response) {
							      $scope.respData = response.data;
								  $(document).ready(function() {
									prepareDynamicDates();
									$("#dash_att_time").timeago();
								  });
							      console.log($scope.respData);
							      var respLength = $scope.respData['length']

							      var container = document.getElementById('timeline');
							      var items = [];
							      for (var i=0;i<respLength;i++) {
							      	var startTime = $scope.respData[i]['date_in']+' '+$scope.respData[i]['att_in'];
							      	var endTime = $scope.respData[i]['date_out']+' '+$scope.respData[i]['att_out'];
							      	var content = $scope.respData[i]['ID']+' : '+$scope.respData[i]['date_in'];
							      	items[i] = {content: content, start: startTime, end: endTime, title: 'AB'};
							      }
								  var items1 = new vis.DataSet(items);

								  // Configuration for the Timeline
								  var options = {
								  	min: $scope.respData[respLength-1]['date_in'],
								  	max: $scope.respData[0]['date_out']
								  	// zoomMax: 1000 * 60 * 60 * 24
								  };

								  // Create a Timeline
								  var timeline = new vis.Timeline(container, items1, options);

							  });

							});

							app1.filter('capitalize', function() {
							    return function(input) {
							      return (!!input) ? input.charAt(0).toUpperCase() + input.substr(1).toLowerCase() : '';
							    }
							});
							angular.bootstrap(document.getElementById("att_record"), ['dashAttRecords']);
						</script>
					    <div class="col-md-4">
					    	<div ng-app="empStatus" ng-controller="empStatusController" id="empStatus" class="card rounded-0 border-0">
					    		<ul class="list-group rounded-0">
								  <li class="list-group-item rounded-0 active">
								  	<strong><span>Employee status</span></strong>
								  	<span class="badge badge-light pull-right" ng-click="reloadEmpButton()"><i class="fa fa-refresh" aria-hidden="true"></i></span>
								  </li>
								  <span ng-repeat="x in respData" ng-hide="!respData.length">
								  <li ng-if=" x.status == 'IN' " class="list-group-item list-group-item-success">
								  	<i class="fa fa-user" aria-hidden="true"></i>  {{ x.firstname+' '+x.lastname }} <span class="badge badge-primary pull-right">{{ x.role }}</span>
								  </li>
								  <li ng-if=" x.status == 'Leave' " class="list-group-item list-group-item-info">
								  	<i class="fa fa-user" aria-hidden="true"></i>  {{ x.firstname+' '+x.lastname }} <span class="badge badge-primary pull-right">{{ x.role }}</span>
								  </li>
								  </span>
								  <p class="small text-secondary text-center emp-status-padding">updated <time id="empStatusTime"></time></p>
								</ul>
					    	</div>
					    </div>
					    <script type="text/javascript">
					    	var app1 = angular.module('empStatus', []);
							app1.controller('empStatusController', function($scope, $http) {
								$scope.reloadEmpStatus = function() {
									$http({
								      method: "POST",
								      url: "app/dashboardEmpStatus.php",
								      data: {
								      	id: userid,
								      	session_key: session_key	
								      },
								      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
								    }).then(function(response) {
								    	$scope.respData = response.data;
								    	$(document).ready(function() {
								    		empStatusTime();
								    		$("#empStatusTime").timeago();
								    	});
								    	console.log(response.data);
								    });
								}

								$scope.reloadEmpButton = function() {
									$scope.reloadEmpStatus();
									notie.alert({text: 'Data refreshed', position: 'bottom', type: 1, time: 1});
								}

								$scope.reloadEmpStatus();
							});
							angular.bootstrap(document.getElementById("empStatus"), ['empStatus']);
					    </script>
					</div>

			<!-- </div> -->
		</div> <!-- container-fluid -->
	</div>
</div>

<script>
var line = new ProgressBar.Circle('#card1', {
  strokeWidth: 6,
  easing: 'easeInOut',
  duration: 1400,
  color: '#0275d8',
  trailColor: '#eee',
  trailWidth: 5,
  svgStyle: null
});
var card1 = Date.getDaysInMonth(Date.today().toString('yyyy'), Date.today().toString('M')-1);

line.animate(Date.today().toString('dd')/card1);

var line1 = new ProgressBar.Circle('#card2', {
  strokeWidth: 6,
  easing: 'easeInOut',
  duration: 1400,
  color: '#0275d8',
  trailColor: '#eee',
  trailWidth: 5,
  svgStyle: null
});
var line2 = new ProgressBar.Circle('#card3', {
  strokeWidth: 6,
  easing: 'easeInOut',
  duration: 1400,
  color: '#0275d8',
  trailColor: '#eee',
  trailWidth: 5,
  svgStyle: null
});

var line4 = new ProgressBar.Line('#att_record', {
  strokeWidth: 0.3,
  easing: 'easeInOut',
  duration: 1400,
  color: '#0275d8',
  trailColor: '#eee',
  trailWidth: 1,
  svgStyle: null
});

line1.animate(workingDaysNow/workingDays);
line2.animate(1);
// line3.animate(1);
line4.animate(1);

$('#sidenav1').addClass('active');
</script>
<script src="js/notie.min.js"></script>

</body>
</html>
