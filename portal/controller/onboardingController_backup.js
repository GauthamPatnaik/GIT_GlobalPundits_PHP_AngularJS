angular.module('myAPP').controller('onboardingController', function($scope, $http) {
	$scope.proccessingTextFlag = false;
	$scope.docxLen = 0;
	$scope.filesCardFlag = false;
	$scope.hasPermission = false;

	$scope.checkAuth= function() {
		$http({
	      method: "POST",
	      url: "app/onboarding_api.php",
	      data: {
	      	id: userid,
	      	session_key: session_key,
	      	type: "checkAuth",	
	      },
	      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	    }).then(function(response) {
	    	console.log(response.data);
	    	$scope.authCheck = response.data;
	    	if ($scope.authCheck.status == "1") {
	    		$scope.hasPermission = true;
	    	}
	    });
	}

	$scope.checkAuth();

	$scope.convertPDF= function(filename,divName) {
		$http({
	      method: "POST",
	      url: "onboard/convert_pdf.php",
	      data: {
	      	id: userid,
	      	session_key: session_key,
	      	candidateID: $scope.candidateID,
	      	filename: filename,	
	      	clientName: $scope.clientName,	
	      },
	      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	    }).then(function(response) {
	    	// $scope.editResp = response.data;
	    	console.log(response.data);
	    	$("#"+divName).removeClass('alert-warning');
	    	$("#"+divName).addClass('alert-success');
	    	$("#"+divName).html('Conversion successfull : '+response.data);
	    	$("#"+divName).wrap('<a href="onboard/'+$scope.clientName+'/converted/'+response.data+'" target="_blank"></a>');
	    	
	    	$scope.docxLen += 1;

	    	if ($scope.docxLen == $scope.editResp.docx.length) {
	    		cardSuccess(2);
	    		showCard(3);
	    	}

	    });
	}

	$scope.editTemplate= function() {
		$http({
	      method: "POST",
	      url: "onboard/"+$scope.clientName+"/edit_template.php",
	      data: {
	      	id: userid,
	      	session_key: session_key,
	      	candidateID: $scope.candidateID,
	      	c_data: $scope.respData.data	
	      },
	      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	    }).then(function(response) {
	    	$scope.editResp = response.data;
	    	console.log(response.data);

	    	// $("#onboarding").append('<div class="card"><div id="filesCard" class="card-body"></div></div>');
	    	$scope.filesCardFlag = true;
	    	$("#filesCard").append('<p>Files - </p>')
	    	for (i=0;i<$scope.editResp.pdf.length;i++) {
	    		$("#filesCard").append('<a href="onboard/'+$scope.clientName+'/converted/'+$scope.editResp.pdf[i]+'" target="_blank"><div id="doneFile'+i+'" class="alert alert-success" role="alert">'+$scope.editResp.pdf[i]+'</div></a>');
	    	}

	    	for (i=0;i<$scope.editResp.docx.length;i++) {
	    		$("#filesCard").append('<div id="convFile'+$scope.candidateID+'_'+i+'" class="alert alert-warning" role="alert">Converting '+$scope.editResp.docx[i]+' to PDF...</div>');
	    		// $scope.convertPDF($scope.editResp.docx[i], 'convFile'+$scope.candidateID+'_'+i);
	    	}

	    	cardSuccess(1);
	    	showCard(2);

	    });
	}

    $scope.fetchCandidate = function() {
    	$http({
	      method: "POST",
	      url: "onboard/bull.php",
	      data: {
	      	id: $scope.candidateID,
	      	feilds: 'name,email,phone'	
	      },
	      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	    }).then(function(response) {
	    	$scope.respData = response.data;
	    	console.log($scope.respData);

	    	if (!$scope.respData.hasOwnProperty('errorMessageKey')) {

	    		$('#proccessingText').html('Success : '+$scope.respData.data.name);
				$('#proccessingText').removeClass('alert-primary');
				$('#proccessingText').removeClass('alert-danger');
				$('#proccessingText').addClass('alert-success');
				cardSuccess(0);
				showCard(1);
				$scope.editTemplate();

	    	} else {

	    		if ($scope.respData.errorMessageKey=="errors.badCommand" || $scope.respData.errorMessageKey=="errors.entityNotFound") {
	    			$('#proccessingText').html('Error: Invalid Candidate ID');
					$('#proccessingText').removeClass('alert-primary');
					$('#proccessingText').removeClass('alert-success');
					$('#proccessingText').addClass('alert-danger');
	    		} else {
	    			$('#proccessingText').html('Error: Please refresh the page and try again');
					$('#proccessingText').removeClass('alert-primary');
					$('#proccessingText').removeClass('alert-success');
					$('#proccessingText').addClass('alert-danger');
	    		}

	    	}

	    });
    };

    $scope.onboardSubmit = function() {
		if ($scope.clientName != "" && $scope.candidateID) {

			$('#proccessingText').html('Getting candidate details from Bullhorn...');
			$('#proccessingText').addClass('alert-primary');
			$('#proccessingText').removeClass('alert-success');
			$('#proccessingText').removeClass('alert-danger');

			$scope.proccessingTextFlag = true;
			console.log('sending request...'+$scope.candidateID);
			$scope.fetchCandidate();
			showCard(0);
		}
	}
});