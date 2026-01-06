
myAPP.controller('genAttController', function($scope, $http, $ocLazyLoad, DTOptionsBuilder, DTColumnBuilder) {

	// $ocLazyLoad.load('js/datedropper.min.js');
	// $ocLazyLoad.load('js/datatables.min.js');
	// $ocLazyLoad.load('js/jquery.table2excel.js');
	// $ocLazyLoad.load('js/genAtt.js');

	$scope.filterValue = '';
	$scope.fromDate = '';
	$scope.toDate = '';

	$scope.filterValueUpdate = function(value, event) {
		$scope.filterValue = value;
		if (value == '') {
			$('#allID').addClass('active').siblings().removeClass('active');
		} else {
			$('#'+value+'ID').addClass('active').siblings().removeClass('active');
		}
	}

	$scope.filters = function() {
		$http({
	      method: "POST",
	      url: "app/genAtt_api.php",
	      data: {
	      	id: userid,
	      	session_key: session_key,
	      	type: 'filterData',
	      	fromDate: $scope.fromDate,
	      	toDate: $scope.toDate	
	      },
	      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	    }).then(function(response) {
          $scope.filterData = response.data;
          console.log(response.data);
          $scope.totalCount = 0;
          for (var i =0;i<$scope.filterData.length;i++) {
            $scope.totalCount = $scope.totalCount + $scope.filterData[i].count;
          }
          if ($scope.filterData.length > 0) {
            notie.alert({type: 1, text: "Data fetched", position: 'bottom', time: 1});
          } else {
            notie.alert({type: 2, text: "Returned 0 rows", position: 'bottom', time: 3});
          }
	    });
	}

	$scope.attendanceData = function() {
		$http({
	      method: "POST",
	      url: "app/genAtt_api.php",
	      data: {
	      	id: userid,
	      	session_key: session_key,
	      	type: 'attData',
	      	fromDate: $scope.fromDate,
	      	toDate: $scope.toDate	
	      },
	      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	    }).then(function(response) {
	    	$scope.attData = response.data;
	    	console.log(response.data);
	    });
	}
  
  $scope.dtOptions = DTOptionsBuilder.fromSource('data.json')
      .withPaginationType('full_numbers');
  $scope.dtColumns = [
      DTColumnBuilder.newColumn('ID').withTitle('ID'),
      DTColumnBuilder.newColumn('date_in').withTitle('Date In'),
      DTColumnBuilder.newColumn('att_in').withTitle('In'),
      DTColumnBuilder.newColumn('date_out').withTitle('Date Out'),
      DTColumnBuilder.newColumn('att_out').withTitle('Out'),
      DTColumnBuilder.newColumn('status').withTitle('Status'),
    ];
      
	$scope.totalCount = 0;

	$scope.fetchData = function() {
		if (Date.parse($scope.toDate).compareTo(Date.parse($scope.fromDate)) == -1) {
			notie.alert({type: 2, text: "Error: To date greater than from date", position: 'bottom', time: 3});
		} else {
			$scope.filters();
			$scope.attendanceData();
		}
	}

	$("#excelExport").click(function(){
	  $("#attTable").table2excel({
	    exclude: "",
	    name: "attendance export data",
	    filename: "eport.xls"
	  });
	});

});
