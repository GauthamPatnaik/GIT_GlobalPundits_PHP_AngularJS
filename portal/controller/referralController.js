myAPP.controller('referralController', function($scope, $http, $ngConfirm, DTOptionsBuilder, DTColumnBuilder, emailService) {
  $scope.upd_bhid = "";
  
  $scope.referralData = function() {
		$http({
	      method: "POST",
	      url: "app/referral_api.php",
	      data: {
	      	id: userid,
          type: 'getRecords',
	      	session_key: session_key
	      },
	      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	    }).then(function(response) {
	    	$scope.referralRecords = response.data;
	    	console.log(response.data);
	    });
	}
  $scope.referralData();
  
  $scope.dtOptions = DTOptionsBuilder.fromSource('data.json')
      .withPaginationType('full_numbers');
  $scope.dtColumns = [
      DTColumnBuilder.newColumn('bh_id').withTitle('BullHorn ID'),    
      DTColumnBuilder.newColumn('r_name').withTitle('Referee Name'),
      DTColumnBuilder.newColumn('r_mail').withTitle('Referee Mail'),
      DTColumnBuilder.newColumn('r_phn').withTitle('Referee Phn'),
      DTColumnBuilder.newColumn('c_name').withTitle('Candidate Name'),
      DTColumnBuilder.newColumn('c_mail').withTitle('Candidate Mail'),
      DTColumnBuilder.newColumn('c_phn').withTitle('Candidate Phn'),
      DTColumnBuilder.newColumn('last_upd').withTitle('Last Updated'),
      DTColumnBuilder.newColumn('status').withTitle('Status'),
      DTColumnBuilder.newColumn('Action').withTitle('Action')
  ];
  
  $scope.sendMailer = function(mailTo) {
    emailService.sendEmail($scope, mailTo);
  }
  
  $scope.sendBHID = function(r_mail, c_mail, bh_id) {
    $http({
	      method: "POST",
	      url: "app/referral_api.php",
	      data: {
	      	id: userid,
          type: 'updateBHID',
          r_mail: r_mail,
          c_mail: c_mail,
          bhid: bh_id,
	      	session_key: session_key
	      },
	      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	    }).then(function(response) {
        if (response.data.status) {
          $ngConfirm({
            title: 'Success',
            content: response.data.message,
            type: 'green',
            theme: 'material'
          });
        } else {
          $ngConfirm({
            title: 'Failed',
            content: response.data.message,
            type: 'red',
            theme: 'material'
          });
        }
        $scope.referralData();
	    	console.log(response.data);
    });
  };
  
  $scope.statusOnHold = function(r_mail, c_mail) {
    $http({
	      method: "POST",
	      url: "app/referral_api.php",
	      data: {
	      	id: userid,
          type: 'updateOnHold',
          r_mail: r_mail,
          c_mail: c_mail,
	      	session_key: session_key
	      },
	      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	    }).then(function(response) {
        if (response.data.status) {
          $ngConfirm({
            title: 'Success',
            content: response.data.message,
            type: 'green',
            theme: 'material'
          });
        } else {
          $ngConfirm({
            title: 'Failed',
            content: response.data.message,
            type: 'red',
            theme: 'material'
          });
        }
        $scope.referralData();
	    	console.log(response.data);
    });
  };
  
  $scope.updateBHID = function(c_name, r_mail, c_mail) {
    c_name = c_name+"'s";
    $ngConfirm({
      title: 'Update BHID',
      content: '<div class="form-group"><label for="upd_bhid">'+c_name+' BullHorn ID</label><input type="text" ng-model="upd_bhid" class="form-control" id="upd_bhid" placeholder=""></div>',
      theme: 'material',
      scope: $scope,
      buttons: {
        Update: {
          text: 'Update BHID',
          btnClass: 'btn-blue',
          action: function(scope, button){
              $scope.sendBHID(r_mail, c_mail, scope.upd_bhid);
              return true; // prevent close;
          }
        },
        close: function(scope, button){
        },
      }
    });
  }

});