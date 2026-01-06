<?php
header("Cache-Control: max-age=2592000");

include("common/db.lib.php");
include("common/session.php");
if (!isset($_COOKIE['session_key']) && !isset($_COOKIE['userid'])) {
	echo "<script>";
  echo "var auth2 = gapi.auth2.getAuthInstance();";
  echo "auth2.signOut();";
//   echo "alert('here)";
	echo "window.location.replace('login.php');";
	echo "</script>";
} else {
	if (!checkSession($_COOKIE['userid'], $_COOKIE['session_key'])) {
		echo "<script>";
    echo "var auth2 = gapi.auth2.getAuthInstance();";
    echo "auth2.signOut();";
		echo "window.location.replace('login.php');";
		echo "</script>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">

    <title>GP Portal</title>

    <!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
    
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/notie.min.css">
	<link rel="stylesheet" type="text/css" href="css/vis.min.css">

	<link rel="stylesheet" type="text/css" href="css/datedropper.min.css">
	<link rel="stylesheet" type="text/css" href="css/genAtt-date-theme.css">
<!-- 	<link rel="stylesheet" type="text/css" href="css/datatables.min.css"> -->

	<link rel="stylesheet" type="text/css" href="css/timedropper.min.css">
	<link rel="stylesheet" type="text/css" href="css/angular-confirm.min.css">
  
<!--   Datatables css -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.16/datatables.min.css"/>

	
	<!-- Loading bar -->
	<!-- <link rel='stylesheet' href='//cdnjs.cloudflare.com/ajax/libs/angular-loading-bar/0.9.0/loading-bar.min.css' type='text/css' media='all' /> -->
	<link rel="stylesheet" type="text/css" href="css/loading-bar.css">
	
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/tether.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.timeago.js" type="text/javascript"></script>
	<script src="js/progressbar.min.js"></script>
	<script src="js/date.js"></script>
	<script src="js/animationCounter.min.js"></script>
	<script src="js/angular.min.js"></script>
	<script src="js/angular-ui-router.min.js"></script>
  
	<script src="js/vis.min.js"></script>
	<script src="js/index.js"></script>
	<script src="js/angular-confirm.min.js"></script>
	<script src="js/ocLazyLoad.min.js"></script>
	<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.4/TweenMax.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.4/TimelineLite.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.4/plugins/CSSPlugin.min.js"></script>
  
<!--   WYSIWYG -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/0.9.2/trix.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/0.9.2/trix.js"></script>
  <script src="js/angular-trix.min.js"></script>

	<!-- <script src="js/loading-bar.js"></script> -->

	<script src="js/datedropper.min.js"></script>
<!-- 	<script src="js/datatables.min.js"></script> -->
	<script src="js/jquery.table2excel.js"></script>

	<script src="js/timedropper.min.js"></script>
	
	<!-- Loading bar JS --> 
	<script type='text/javascript' src='//cdnjs.cloudflare.com/ajax/libs/angular-loading-bar/0.9.0/loading-bar.min.js'></script>
	<!-- <script src="js/genAtt.js"></script> -->

	<!-- mdbootstrap files -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.0/css/mdb.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
  
<!--   datatables js -->
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.16/datatables.min.js"></script>
  <script src="js/angular-datatables.min.js"></script>
  
<!--   ng-flow -->
  <script src="js/ng-flow-standalone.min.js"></script>
  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/textAngular/1.5.0/textAngular.css" rel="stylesheet"/>
  <script src='https://cdn.jsdelivr.net/g/angular.textangular@1.5.0(textAngular-rangy.min.js+textAngular-sanitize.min.js+textAngular.min.js)'></script>
  
<!--   input tag -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/ng-tags-input/3.2.0/ng-tags-input.min.css"/>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/ng-tags-input/3.2.0/ng-tags-input.bootstrap.min.css"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ng-tags-input/3.2.0/ng-tags-input.min.js"></script>
  
	<!-- Angular JS Files  -->
	<script src="js/app.js"></script>
  <script src="controller/services.js"></script>
	<script src="controller/headerController.js"></script>
	<script src="controller/indexController.js"></script>
	<script src="controller/markAttController.js"></script>
	<script src="controller/genAttController.js"></script>
	<script src="controller/modAttController.js"></script>
	<script src="controller/genRepController.js"></script>
	<script src="controller/approveAttController.js"></script>
	<script src="controller/onboardingController.js"></script>
	<script src="controller/onboardingStatusController.js"></script>
	<script src="controller/referralController.js"></script> 
  <script src="controller/schedulerController.js"></script> 
<script src="controller/reportController.js"></script> 
<script src="controller/rtrController.js"></script> 
 

<script>
	

</script>
</head>

<body>

<?php 
include('views/general/topnav.html');
?>

<div id='router' ng-app='myAPP' class="main-container">
	<?php
	include('views/general/sidenav.html');
	?>

	<div id="content-area" class="content-pane">
		<ui-view></ui-view>
	</div>

</div>

<script src="js/notie.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.5.0/js/mdb.min.js"></script>
  
</body>

<script type="text/javascript">
	myAPP.config(function($stateProvider, $urlRouterProvider, $stateProvider) {

	  $stateProvider.state('home', {
	  	name: 'home',
	  	url: '/Dashboard',
	  	templateUrl: 'views/general/dashboard.html'
	  });

	  $stateProvider.state('markAtt', {
	  	name: 'markAtt',
	  	url: '/Mark_Attendance',
	  	templateUrl: 'views/general/markAtt.html'
	  });

	  $stateProvider.state('genAtt', {
	  	name: 'genAtt',
	  	url: '/Generate_Attendance',
	  	templateUrl: 'views/general/genAtt.html'
	  });

	  $stateProvider.state('modAtt', {
	  	name: 'modAtt',
	  	url: '/Modify_Attendance',
	  	templateUrl: 'views/general/modAtt.html'
	  });
	  
	  $stateProvider.state('approveAtt', {
	  	name: 'approveAtt',
	  	url: '/Approve_Attendance',
	  	templateUrl: 'views/general/approveAtt.html'
	  });
    
    $stateProvider.state('genRep', {
	  	name: 'genRep',
	  	url: '/Generate_Report',
	  	templateUrl: 'views/general/genRep.html'
	  });
	  
	  $stateProvider.state('onboarding', {
	  	name: 'onboarding',
	  	url: '/Onboarding',
	  	templateUrl: 'onboard/onboard.html'
	  });

	  $stateProvider.state('onboarding_status', {
	  	name: 'onboarding_status',
	  	url: '/OnboardingStatus',
	  	templateUrl: 'onboard/onboard_status.html'
	  });
             
               $stateProvider.state('rtr', {
	  	name: 'rtr',
	  	url: '/rtr',
	  	templateUrl: 'onboard/rtr.html'
	  });
    
    $stateProvider.state('admin', {
	  	name: 'admin',
	  	url: '/AdminDash',
	  	templateUrl: 'views/general/admin_dash.html'
	  });
    
    $stateProvider.state('referrals', {
	  	name: 'referrals',
	  	url: '/Referrals',
	  	templateUrl: 'views/general/referrals.html'
	  });
    
    $stateProvider.state('scheduler', {
	  	name: 'scheduler',
	  	url: '/scheduler',
	  	templateUrl: 'views/general/appScheduler.html'
	  });
    $stateProvider.state('report', {
	  	name: 'report',
	  	url: '/Report',
	  	templateUrl: 'views/general/report.html'
	  });

	  $urlRouterProvider.otherwise('/Dashboard')
	});
	angular.bootstrap(document.getElementById("router"), ['myAPP']);

	Waves.attach('.btn', ['waves-effect']);
	Waves.attach('.list-group-item', ['waves-light']);
  Waves.attach('tr', ['waves-light']);
</script>
</html>
