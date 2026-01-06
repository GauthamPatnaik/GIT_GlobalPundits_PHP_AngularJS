var cName = "";
app.controller('navProfileLoader', function($scope, $http) {
	$scope.empID = userid;
	$http({
      method: "POST",
      url: "/app/dashboard_nav.php",
      data: {
      	id: userid,
      	session_key: session_key	
      },
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    }).then(function(response) {
      $scope.myWelcome = response.data;
      console.log($scope.myWelcome);
      cName = $scope.myWelcome.firstname + " " + $scope.myWelcome.lastname;

      $('#passChangeModal').modal({
		    backdrop: 'static',
		    keyboard: false,
		    show: false
	  });

	  
	  if ($scope.myWelcome.first_login == 'y') {
	  	$('#passChangeModal').modal('show');
	  }

	  $('#passModal1').html(cName);

	  $('#passModalAlert').hide();
	  $('#passModalSubmit').on('click', function() {
	  	// $('#passChangeModal').modal('hide');

	  	// $('#passModalSubmit').bind('click');
	  	var oldPass = $('#modalOldPassword').val();
	  	var newPass = $('#modalNewPassword').val();
	  	var rePass = $('#modalRePassword').val();

	  	var letter = /[a-zA-Z]/;
		var number = /[0-9]/;
	  	var errorText = '';
	  	if (oldPass.length == 0) {
	        errorText = 'Please enter the current password';
	        $('#passChangeOld').addClass('invalid');
	    }
	  	else if (newPass.length < 6) {
	        errorText = 'New password length is less than 6 characters';
	        $('#passChangeNew').addClass('invalid');
	    }
	    else if (!letter.test(newPass) || !number.test(newPass)) {
	        errorText = 'New password should contain atleast one number and also cannot be all numbers';
	        $('#passChangeNew').addClass('invalid');
	    }
	    else if (newPass!==rePass) {
	        errorText = 'New passwords do not match';
	        $('#passChangeNew').addClass('invalid');
	        $('#passChangeRe').addClass('invalid');
	    } else {
	    	$('#passModalAlert').hide();
	    	$('#passChangeNew').removeClass('invalid');
	        $('#passChangeRe').removeClass('invalid');
	        $('#passModalSubmit').html('Proccessing');

	        $http({
		      method: "POST",
		      url: "/app/changePass_api.php",
		      data: {
		      	id: userid,
		      	session_key: session_key,
		      	oldPass: oldPass,
		      	newPass: newPass	
		      },
		      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
		    }).then(function(response) {
		  		console.log(response.data.status);

		  		if (response.data.status == 'same pass') {
		  			$('#passModalAlert').show();
	  				$('#passModalAlert').html('You cannot set the same password again');
	  				$('#passChangeNew').addClass('invalid');
	  				$('#passModalSubmit').html('Change password');
		  		}
		  		else if (response.data.status == 'match failed') {
		  			$('#passModalAlert').show();
	  				$('#passModalAlert').html('Current password is incorrect');
	  				$('#passChangeOld').addClass('invalid');
	  				$('#passModalSubmit').html('Change password');
		  		}
		  		else {
		  			$('#passModalSubmit').removeClass('btn-outline-primary');
		  			$('#passModalSubmit').addClass('btn-success');
		  			$('#passChangeNew').removeClass('invalid');
		  			$('#passChangeOld').removeClass('invalid');
		  			$('#passChangeRe').removeClass('invalid');
		  			$('#passModalSubmit').html('Success');

		  			setTimeout(function() 
					{
					    $('#passChangeModal').modal('hide');
					}, 2000);
		  		}
		  	});
	    }
	    
	    if (errorText != '') {
	  		$('#passModalAlert').show();
	  		$('#passModalAlert').html(errorText);
	  		$('#passModalSubmit').html('Change password');
	  	}

	  });
  });
});
app.filter('capitalize', function() {
    return function(input) {
      return (!!input) ? input.charAt(0).toUpperCase() + input.substr(1).toLowerCase() : '';
    }
});