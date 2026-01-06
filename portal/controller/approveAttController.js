angular.module('myAPP').controller('approveAttController', function($scope, $http) {
	$scope.actionType = "";
	$scope.requestID = "";
	$scope.fetchRecords = function() {
		$http({
	      method: "POST",
	      url: "app/approveAtt_api.php",
	      data: {
	      	id: userid,
	      	session_key: session_key,
	      	type: 'attApprovalRecords'
	      },
	      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	    }).then(function(response) {
	    	$scope.records = response.data;
	    	console.log($scope.records);
	    });
	}
	$scope.authAction = function() {
		$http({
	      method: "POST",
	      url: "app/approveAtt_api.php",
	      data: {
	      	id: userid,
	      	session_key: session_key,
	      	type: $scope.actionType,
	      	req_id: $scope.requestID,
	      	remark: $scope.remarkText
	      },
	      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	    }).then(function(response) {
	    	$scope.actionResponse = response.data;
	    	if ($scope.actionResponse == 'true') {
	    		notie.alert({type: 1, text: "Success", position: 'bottom', time: 1});
	    	} else {
	    		notie.alert({type: 2, text: "Failed: Please try again later", position: 'bottom', time: 1});
	    	}
	    	$scope.fetchRecords();
	    });
	}

	$scope.approveAction = function(val) {
		$scope.actionType = 'approveRequest';
		$scope.requestID = val;
		$scope.remarkText = $('#remark'+val).val();

		$scope.authAction();
		// alert($scope.remarkText);
	}
	$scope.rejectAction = function(val) {
		$scope.actionType = 'rejectRequest';
		$scope.requestID = val;
		$scope.remarkText = $('#remark'+val).val();
		
		$scope.authAction();
	}

	$http({
      method: "POST",
      url: "app/approveAtt_api.php",
      data: {
      	id: userid,
      	session_key: session_key,
      	type: 'authCheck'
      },
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    }).then(function(response) {
    	$scope.flag = response.data;
    	console.log(response.data);
    	if ($scope.flag.auth != 'false') {
    		$scope.fetchRecords();
    	}
    });
});