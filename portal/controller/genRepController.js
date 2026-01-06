
myAPP.controller('genRepController', function($scope, $http) {
	$scope.fromDate = '';
	$scope.toDate = '';
  
  $scope.checkAccess = function() {
		$http({
	      method: "POST",
	      url: "app/role_api.php",
	      data: {
	      	id: userid,
	      	session_key: session_key,
	      	role_id: '2006'
	      },
	      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	    }).then(function(response) {
	    	$scope.access = response.data;
	    	console.log(response.data);
	    });
	}
  
  $scope.checkAccess();
  
	$scope.reportData = function() {
		$http({
	      method: "POST",
	      url: "app/genRep_api.php",
	      data: {
	      	id: userid,
	      	session_key: session_key,
	      	fromDate: $scope.fromDate,
	      	toDate: $scope.toDate	
	      },
	      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	    }).then(function(response) {
	    	$scope.repData = response.data;
	    	console.log(response.data);
	    });
	}
  
  $scope.exportData = function() {
    alert('exporting');
    $("#repTable").table2excel({
	    exclude: "",
	    name: "attendance export data",
	    filename: "export.xls"
	  });
  }
  

});
