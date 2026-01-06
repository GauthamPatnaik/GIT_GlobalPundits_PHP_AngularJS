angular.module('myAPP').controller('onboardingController', function($scope, $http, $ngConfirm) {
	$scope.clientName = 'Select client';
	$scope.proccessingTextFlag = false;
	$scope.hasPermission = false;
	$scope.showFields = false;
  $scope.respData = {
    name: '',
    phone: '',
    email: '',
    clientLocation: '',
    GPLocation: '',
    subConNum: '',
    bcbsID: '',
    manager: '',
    div: '',
    cc: '',
    location: '',
    title: '',
    company: '',
    gpOfferStartDate: '',
    moxGETDate: '',
    moxLoA: '',
    moxReqNum: '',
    gpOfferJobTitle: '',
    gpOfferClientAssignment: '',
    gpOfferWorkLocation: '',
    gpOfferOvertime: '',
    gpOfferExemptionStatus: '',
    gpOfferVacation: '',
    gpOfferHolidays: '',
    gpOfferDental: '',
    isPerDiem: false,
    gpPerDiemPrincipalPlaceOfBusiness: '',
    gpPerDiemPermAddress: '',
    gpPerDiemTempAddress: '',
    gpPerDiemTempContactPerson: ''
  };
	$scope.docuSignSubject = "Welcome to Globalpundits: Onboarding Documents to Complete Today";
	$scope.docuSignMailBody = "Please read, complete and sign all the attached client and Globalpundits documents today. If you have any questions please call 803-354-9400 #1.";
  $scope.envCC = [];
  
  var newVal={'text':'joe@globalpundits.com'};    
  $scope.envCC.push(newVal);

	// $ngConfirm('Your document has been sent.', 'Welcome User');

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

    $scope.fetchCandidate = function(d) {
    	$http({
	      method: "POST",
	      url: "onboard/bull.php",
	      data: {
	      	id: $scope.candidateID
	      },
	      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	    }).then(function(response) {
        console.log(response.data.data);
        $scope.response = response.data.data;
        
        var totalPayRate = '$'+$scope.response.customPayRate1+' W2';
        if ($scope.response.customText4 == 'Yes') {
          totalPayRate += ' + $'+$scope.response.customPayRate7+' PerDiem';
        }
        totalPayRate += ' / $'+$scope.response.overtimeRate+' OT';
        
        var ptovacation = '';
        if ($scope.response.customText5 == 'Yes') {
          ptovacation = $scope.response.customText5+', '+$scope.response.customText9+' hours per pay period';
        } else {
          ptovacation = $scope.response.customText5;
        }
        
        var startDate = new Date($scope.response.dateBegin);
        var dental = '';
        if ($scope.response.customText12 == 'Yes') {
          dental = 'Yes';
        } else {
          dental = 'No';
        }
        
        
	    	$scope.respData = {
          name: $scope.response.candidate.name,
          phone: $scope.response.candidate.phone,
          email: $scope.response.candidate.email,
          canID: $scope.response.candidate.id,
          clientLocation: '',
          GPLocation: '',
          subConNum: '',
          bcbsID: '',
          manager: '',
          div: '',
          cc: '',
          location: '',
          title: $scope.response.jobOrder.title,
          company: '',
          gpOfferStartDate: startDate.toString('MM/dd/yyyy'),
          moxGETDate: '',
          moxLoA: '',
          moxReqNum: '',
          gpOfferJobTitle: $scope.response.jobOrder.title,
          gpOfferClientAssignment: $scope.response.jobOrder.clientCorporation.name,
          gpOfferWorkLocation: $scope.response.jobOrder.clientCorporation.address.city+', '+$scope.response.jobOrder.clientCorporation.address.state+' - '+$scope.response.jobOrder.clientCorporation.address.zip+', '+$scope.response.jobOrder.clientCorporation.address.countryCode,
          gpOfferOvertime: totalPayRate,
          gpOfferExemptionStatus: $scope.response.customText8,
          gpOfferVacation: ptovacation,
          gpOfferHolidays: $scope.response.customText6,
          gpOfferDental: dental
        };
        
        $scope.respData.gpPerDiemPrincipalPlaceOfBusiness = $scope.respData.gpOfferWorkLocation;
        if ($scope.response.customPayRate7 > 0) {
          $scope.respData.isPerDiem = true;
        }
// 	    	$scope.respData.gpOfferStartDate = "";
        
//         format phone number
        if ($scope.respData.phone) {
          $scope.respData.phone = $scope.respData.phone.replace(/[^0-9]/, '');
          if ($scope.respData.phone.charAt(0) == "1") {
            $scope.respData.phone = $scope.respData.phone.substr(1);
          }
          $scope.respData.phone = "+1 "+$scope.respData.phone; 
        }

	    	if (!response.data.hasOwnProperty('errorMessageKey')) {

          $('#proccessingText').html('Success : '+$scope.respData.name);
          $('#proccessingText').removeClass('alert-primary');
          $('#proccessingText').removeClass('alert-danger');
          $('#proccessingText').addClass('alert-success');

          $scope.showFields = true;

  // 				$scope.respData.email = "";
          d.close();

	    	} else {
	    		$scope.showFields = false;
	    		d.close();
	    		if (response.data.errorMessageKey=="errors.badCommand" || response.data.errorMessageKey=="errors.entityNotFound") {
	    			$('#proccessingText').html('Error: Invalid Candidate ID');
            $('#proccessingText').removeClass('alert-primary');
            $('#proccessingText').removeClass('alert-success');
            $('#proccessingText').addClass('alert-danger');

            $ngConfirm({
              title: 'Error',
              content: 'Placement ID not found, please check the value entered',
              type: 'red'
            });

	    		} else {
	    			$('#proccessingText').html('Error: Please refresh the page and try again');
            $('#proccessingText').removeClass('alert-primary');
            $('#proccessingText').removeClass('alert-success');
            $('#proccessingText').addClass('alert-danger');

            $ngConfirm({
                title: 'Error',
                content: 'Please refresh the page and try again',
                type: 'red'
              });

	    		}

	    	}

	    });
    };

    $scope.onboardSubmit = function() {
		if (($scope.clientName != "" || $scope.clientName != "Select client") && $scope.candidateID) {

			$('#proccessingText').html('Getting candidate details from Bullhorn...');
			$('#proccessingText').addClass('alert-primary');
			$('#proccessingText').removeClass('alert-success');
			$('#proccessingText').removeClass('alert-danger');

			$scope.proccessingTextFlag = true;
			console.log('sending request...'+$scope.candidateID);

			var d = $ngConfirm({
				title: 'Fetching details',
				content: 'Fetching candidate details from BullHorn',
				type: 'blue',
				buttons: false,
				closeIcon: false,
        icon: 'fas fa-cloud-download-alt'
			});

			$scope.fetchCandidate(d);
		}
	}

	$scope.sendEnvelope = function() {
		var d = $ngConfirm({
				title: 'Sending Documents',
				content: 'Editing the templates and sending, please wait...',
				buttons: false,
        type: 'blue',
				closeIcon: false,
				icon: 'fa fa-cog fa-spin',
		});

		console.log($scope.respData);

		$http({
	      method: "POST",
	      url: "onboard/"+$scope.clientName+"/"+$scope.clientName+"_template.php",
	      data: {
	      	id: userid,
	      	session_key: session_key,
	      	data: $scope.respData,
	      	bhID: $scope.respData.canID,
	      	client: $scope.clientName,
	      	subject: $scope.docuSignSubject,
	      	body: $scope.docuSignMailBody,
          envCC: $scope.envCC
	      },
	      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	    }).then(function(response) {
	    	console.log(response.data);
	    	d.close();

	    	$scope.textBox();
      
	    });
	}
   
  $scope.smsContent = '';
  
  $scope.sendText = function() {
    $http({
      method: "POST",
      url: "app/textAlert_api.php",
      data: {
        id: userid,
        session_key: session_key,
        phone: $scope.respData.phone,
        content: $scope.smsContent,
      },
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    }).then(function(response) {
      console.log(response.data);
      $ngConfirm({
        title: 'Text alert sent',
        content: 'Text alert sent to '+$scope.respData.name+' successfully',
        type: 'green',
        closeIcon: true,
        icon: 'fa fa-check',
        backgroundDismiss: true
      });
    });
  }
  
  $scope.textUsAlert = '';
  
  $scope.textBox = function() {
    $ngConfirm({
      title: 'Envelope sent successfully',
      contentUrl: 'templates/text_us.html',
      scope: $scope,
      type: 'green',
      icon: 'far fa-envelope',
      buttons: {
        send: {
          text: 'Send', // Some Non-Alphanumeric characters
          action: function(){
              if ($scope.smsContent.length>140) {
                $scope.textUsAlert = 'Error: Text alert content more than 140 characters';
                
                return false;
              } else {
                $scope.textUsAlert = '';
                $scope.sendText();
              }
          },
          btnClass: 'btn-blue btn-rounded'
        },
        cancel: {
          text: 'Cancel', // Some Non-Alphanumeric characters
          btnClass: 'btn-red btn-rounded'
        }
      }
    });
  }

});