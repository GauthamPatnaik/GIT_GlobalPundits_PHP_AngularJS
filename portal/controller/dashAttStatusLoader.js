var att_status = "";
var att_color = "";


// var app1 = angular.module('dashAttStatus', []);
myAPP.controller('dashAttStatusLoader', function($scope, $http) {
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