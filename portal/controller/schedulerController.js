myAPP.controller('schedulerController', function($scope, $http, $ngConfirm) {
  $scope.manAdd = {};
  $scope.tableData = [];
  $scope.showManual = false;
  $scope.tearsheetName = 'Job #11240 | Business Analyst - Project Lead';
  $scope.candidateID = '';
  $scope.addQues = '';
  $scope.addQuesType = 'text';
  $scope.subject = 'Subject of email goes here';
  $scope.desc = 'Descritption of email goes here. The link to schedule the interview will be included after this description';
  $scope.quesArray = [
    {
      'q': 'Question 1',
      't': 'text',
      'a': ''
    },
    {
      'q': 'Question 2',
      't': 'text',
      'a': ''
    },
    {
      'q': 'Question 3',
      't': 'boolean',
      'a': ''
    },
    {
      'q': 'Question 4',
      't': 'text',
      'a': ''
    }
  ];
  
  $scope.getByTearsheet = function() {
		if ($scope.tearsheetName != '') {
      $http({
	      method: "POST",
	      url: "app/app_scheduler/get_tearsheet.php",
	      data: {
	      	id: userid,
          tname: $scope.tearsheetName,
	      	session_key: session_key
	      },
	      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	    }).then(function(response) {
        
        if (response.data.count > 0) {
          $scope.temp = response.data.data[0].candidates.data;
          for (i=0;i<$scope.temp.length;i++) {
            var re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
            
            if (re.test($scope.temp[i].email)) {
              $scope.tableData.push($scope.temp[i]);
            }
          }
        }
        
	    	console.log($scope.tableData);
	    });
      
      $scope.tearsheetName = '';
    }
	}
  
  $scope.getByCandidateID = function() {
		if ($scope.candidateID != '') {
      $http({
	      method: "POST",
	      url: "app/app_scheduler/get_candidate.php",
	      data: {
	      	id: userid,
          BHID: $scope.candidateID,
	      	session_key: session_key
	      },
	      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	    }).then(function(response) {
        var re = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
        if (response.data.data.length > 0) {
          $scope.temp = response.data.data;
          for (i=0;i<$scope.temp.length;i++) {
            
            if (re.test($scope.temp[i].email)) {
              $scope.tableData.push($scope.temp[i]);
            }
          }
        } else {
//           $scope.tableData.push(response.data.data);

          if (re.test(response.data.data.email)) {
            $scope.tableData.push(response.data.data);
          }
        }
        
	    	console.log(response.data);
	    });
      
      $scope.candidateID = '';
    }
	}
  
  $scope.addManual = function() {
    if ($scope.manAdd.id && $scope.manAdd.firstName && $scope.manAdd.lastName && $scope.manAdd.email) {
      $scope.manArray = {
        'id': $scope.manAdd.id,
        'firstName': $scope.manAdd.firstName,
        'lastName': $scope.manAdd.lastName,
        'email': $scope.manAdd.email,
      }
      $scope.tableData.push($scope.manArray);
      $scope.manAdd = {};
      
      $scope.showManual = false;
    }
  }
  $scope.cancelManual = function() {
    $scope.manAdd = {};
    $scope.showManual = false;
  }
  
  $scope.removeFromTable = function(index, table) {
    table.splice(index, 1);
  }

  $scope.addQues = function() {
    $scope.tempQues = {
      'q': $scope.addQuestion,
      't': $scope.addQuesType,
      'a': ''
    }

    $scope.quesArray.push($scope.tempQues);

    $scope.addQuestion = '';
  }

  $scope.sendRequest = function() {
    $http({
      method: "POST",
      url: "app/app_scheduler/send_appointment.php",
      data: {
        id: userid,
        session_key: session_key,
        subject: $scope.subject,
        desc: $scope.desc,
        ques: $scope.quesArray,
        appData: $scope.tableData
      },
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    }).then(function(response) {
      if (response.data = "success") {
        $ngConfirm('Appointment email(s) sent successfully','Success')
        $scope.tableData = [];
      }
    });
  }
});