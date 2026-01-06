angular.module('myAPP').controller('modAttController', function($scope, $http) {
	$scope.displayRecord = false;
	$scope.modifyRecord = false;
	$scope.modifyType = '';
	$scope.dateOutText = 'same';

  	$scope.date_in = '';
  	$scope.date_out = '';
  	$scope.time = {};
  	// $scope.att_in = '';
  	// $scope.att_out = '';

	var att_in = angular.element( document.querySelector( '#att_in' ) );
	var att_out = angular.element( document.querySelector( '#att_out' ) );
	var date_out = angular.element( document.querySelector( '#date_out' ) );

	var att_in_input = angular.element( document.querySelector( '#att_in_input' ) );
	var att_out_input = angular.element( document.querySelector( '#att_out_input' ) );
	// var date_out_input = angular.element( document.querySelector( '#date_out_input' ) );
	// $scope.recDate = '';

	$scope.submittedRecords = function() {
		// alert(att_in_input.val());
		$http({
	      method: "POST",
	      url: "app/modAttFetch_api.php",
	      data: {
	      	id: userid,
	      	session_key: session_key,
	      	type: 'submittedData'
	      },
	      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	    }).then(function(response) {
	    	$scope.subData = response.data;
	    	console.log($scope.subData);
	    });   
	}
	$scope.submittedRecords();

	$scope.getRecord = function() {
		$scope.modifyRecord = false;
		$http({
	      method: "POST",
	      url: "app/modAttFetch_api.php",
	      data: {
	      	id: userid,
	      	session_key: session_key,
	      	type: 'getRecord',
	      	recDate: $scope.recDate	
	      },
	      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	    }).then(function(response) {
	    	$scope.recordData = response.data;
	    	if ($scope.recordData.length > 0) {
	    		$scope.date_in = $scope.recordData[0].date_in;
	    		$scope.date_out = $scope.date_in;
	    	}
	    	$scope.resetView();
	    	console.log(response.data);
	    });
	}
	$scope.modifyIn = function() {
		$scope.modifyRecord = true;
		$scope.modifyType='in';
		att_in_input.val(att_in.html());
	}
	$scope.modifyOut = function() {
		$scope.modifyRecord = true;
		$scope.modifyType='out';
		att_out_input.val(att_out.html());
		// date_out_input.val(date_out.html());
	}
	$scope.modifyBoth = function() {
		$scope.modifyRecord = true;
		$scope.modifyType='both';
		att_in_input.val(att_in.html());
		att_out_input.val(att_out.html());
		// date_out_input.val(date_out.html());
	}
	$scope.sameBtn = function() {
		$('#sameDayBtn').addClass('btn-primary');
		$('#sameDayBtn').removeClass('btn-outline-primary');
		$('#nextDayBtn').removeClass('btn-primary');
		$('#nextDayBtn').addClass('btn-outline-primary');
	}
	$scope.nextBtn = function() {
		$('#nextDayBtn').addClass('btn-primary');
		$('#nextDayBtn').removeClass('btn-outline-primary');
		$('#sameDayBtn').removeClass('btn-primary');
		$('#sameDayBtn').addClass('btn-outline-primary');
	}
	$scope.resetView = function() {
		$scope.displayRecord = true;
    	$scope.dateOutText = 'same';
    	$scope.modifyRecord = false;
    	$scope.sameBtn();
	}
	$scope.dateOutSelect = function(val) {
		if (val == 'same') {
			$scope.sameBtn();
			$scope.dateOutText = 'same';
			$scope.date_out = $scope.date_in;
		} else if (val == 'next') {
			$scope.nextBtn();
			$scope.dateOutText = 'next';
			$scope.date_out = Date.parse($scope.date_in).add(1).day().toString('yyyy-MM-dd');
		}
		// alert($scope.dateOutText);
	}

	$scope.postRequest = function() {
		// alert(att_in_input.val());
		$http({
	      method: "POST",
	      url: "app/modAttSubmit_api.php",
	      data: {
	      	id: userid,
	      	session_key: session_key,
	      	type: $scope.modifyType,
	      	date_in: $scope.date_in,
	      	date_out: $scope.date_out,
	      	att_in: att_in_input.val(),
	      	att_out: att_out_input.val()
	      },
	      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	    }).then(function(response) {
	    	$scope.postData = response.data;
	    	$scope.resetView();
	  		if ($scope.postData.code == "0") {
	  			notie.alert({type: 2, text: $scope.postData.status, position: 'bottom', time: 1});
	  		} else if ($scope.postData.code == "1") {
	  			notie.alert({type: 1, text: $scope.postData.status, position: 'bottom', time: 1});
	  			$scope.submittedRecords();
	  		}
	    	console.log(response.data);
	    });  
	}
	

});