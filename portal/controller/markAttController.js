myAPP.controller('markAttController', function($scope, $http) {
	

    $scope.reloadData = function() {
    	$http({
	      method: "POST",
	      url: "app/markAtt_api.php",
	      data: {
	      	id: userid,
	      	session_key: session_key,
	      	type: 'fetch'	
	      },
	      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	    }).then(function(response) {
	    	$scope.respData = response.data;
	    	$scope.attStatus = $scope.respData.status;
	    	console.log(response.data);
	    });
    };
    $scope.reloadData();
    $scope.markAtt = function() {
    	$http({
	      method: "POST",
	      url: "app/markAtt_api.php",
	      data: {
	      	id: userid,
	      	session_key: session_key,
	      	type: 'MARK',	
	      },
	      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	    }).then(function(response) {
	    	$scope.respData1 = response.data;
	    	$scope.newStatus = $scope.respData1;

	    	console.log(response.data);
	    	if ($scope.newStatus != $scope.attStatus && $scope.newStatus == 'IN') {
	    		markText = "Marked attendance IN";
	    	} else if ($scope.newStatus != $scope.attStatus && $scope.newStatus == 'OUT') {
	    		markText = "Marked attendance OUT";
	    	} else if ($scope.newStatus == $scope.attStatus) {
	    		markText = "Updated OUT time";
	    	}
	    	console.log($scope.newStatus);
	    	notie.alert({type: 1, text: markText, position: 'bottom'});
	    	$scope.reloadData();
	    });
    };
    $scope.alertUser = function() {
    	if ($scope.attStatus == 'Status unknown') {
    		alertText = "Mark attendance IN?";
    	} else if ($scope.attStatus == "IN") {
    		alertText  = "Mark attendance OUT?";
    	} else {
    		alertText = "Update OUT time?"
    	}

    	notie.confirm({
    		text: alertText,
    		position: 'bottom',
    		submitCallback: function() {$scope.markAtt()}
    	});
    }
    $scope.reloadButton = function() {
    	$scope.reloadData();
    	notie.alert({type: 1, text: 'Data refreshed', position: 'bottom', time: 1});
    }

});