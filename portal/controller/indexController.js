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
	var line3 = new ProgressBar.Circle('#card4', {
	  strokeWidth: 6,
	  easing: 'easeInOut',
	  duration: 1400,
	  color: att_color,
	  trailColor: '#eee',
	  trailWidth: 5,
	  svgStyle: null
	});

	// alert(att_color);
	var day = Date.today().toString('dd');
	var month = Date.today().toString('MMMM');

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
	
  if ($scope.respData.status == "IN") {
  	var time_in = Date.parse($scope.respData.date_in+"T"+$scope.respData.att_in+"-04:00");
  	var time_from_in = Math.floor(time_in.getElapsed()/60000);
  	$('.count3-1').animationCounter({
		  start: 0,
		  end: Math.floor(time_from_in/60)-2,
		  delay: 1000/Math.floor(time_from_in/60)
		});
		$('.count3-2').animationCounter({
		  start: 0,
		  end: time_from_in%60,
		  delay: 1000/time_from_in%60
		});
		
		
		var repeater = setInterval(function() {
  		var time_from_in_new = Math.floor(time_in.getElapsed()/60000);
  		
		  $("#in_hr").html(Math.floor(time_from_in_new/60)-2);
		  $("#in_min").html(time_from_in_new%60);
		}, 60000);
  }
  
  if ($scope.respData.status == "OUT") {
  	clearInterval(repeater);
  	var time_in_out = Date.parse($scope.respData.date_in+"T"+$scope.respData.att_in+"-04:00");
  	var time_from_in_out = time_in_out.getElapsed()/60000;
  	
  	var time_out = Date.parse($scope.respData.date_out+"T"+$scope.respData.att_out+"-04:00");
  	var time_from_out = time_out.getElapsed()/60000;
  	
  	var time_diff = Math.floor(time_from_in_out - time_from_out);
  	
  	$('.count3-1').animationCounter({
		  start: 0,
		  end: Math.floor(time_diff/60),
		  delay: 1000/Math.floor(time_diff/60)
		});
		$('.count3-2').animationCounter({
		  start: 0,
		  end: time_diff%60,
		  delay: 1000/time_diff%60
		});
  }
  
	
	$('#displayMessage').html(cName);
	line3.animate(1);
	line1.animate(workingDaysNow/workingDays);
	line2.animate(1);
	line4.animate(1);
	console.log($scope.respData);
  });
});
myAPP.filter('capitalize', function() {
    return function(input) {
      return (!!input) ? input.charAt(0).toUpperCase() + input.substr(1).toLowerCase() : '';
    }
});

myAPP.controller('dashAttRecordsLoader', function($scope, $http) {
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

myAPP.filter('capitalize', function() {
    return function(input) {
      return (!!input) ? input.charAt(0).toUpperCase() + input.substr(1).toLowerCase() : '';
    }
});

myAPP.controller('empStatusController', function($scope, $http) {
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