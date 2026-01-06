myAPP.controller('onboardingStatusController', function($scope, $http, empService, emailService, $ngConfirm, DTOptionsBuilder, DTColumnBuilder) {
	$scope.showRefresh = true;

  $scope.getAllRecords = function() {
    $http({
      method: "POST",
      url: "app/onboardStatus_api.php",
      data: {
        id: userid,
        session_key: session_key,
        type: 'allRecords'	
      },
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    }).then(function(response) {
      $scope.respData1 = response.data;
      console.log($scope.respData1);
//       $scope.ashfaq = 'Ashfaque Ahmed';

      $(document).ready(function() {
      jQuery("time.timeago").timeago();
    });

    $scope.showRefresh = false;
    });
  };
  
  $scope.dtOptions = DTOptionsBuilder.fromSource('data.json')
      .withPaginationType('full_numbers');
  $scope.dtColumns = [
      DTColumnBuilder.newColumn('bhID').withTitle('BHID'),    
      DTColumnBuilder.newColumn('name').withTitle('Name'),
      DTColumnBuilder.newColumn('client').withTitle('Client'),
      DTColumnBuilder.newColumn('mailID').withTitle('Email'),
      DTColumnBuilder.newColumn('sentby').withTitle('Sent by'),
      DTColumnBuilder.newColumn('stime').withTitle('Last upd'),
      DTColumnBuilder.newColumn('estatus').withTitle('Candidate Phn'),
      DTColumnBuilder.newColumn('last_upd').withTitle('Last Updated'),
//       DTColumnBuilder.newColumn('Download').withTitle('Download'),
      DTColumnBuilder.newColumn('Action').withTitle('Action')
  ];
  
  $scope.resendEnvelope = function(envID,name,email) {
    $http({
      method: "POST",
      url: "onboard/docusign_resend.php",
      data: {
        id: userid,
        session_key: session_key,
        name: name,
        email: email,
        envID: envID
      },
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    }).then(function(response) {
      $scope.resendResp = response.data;
      console.log($scope.resendResp);
      
      var notice = "";
      var ncolor = "green";
      if($scope.resendResp.hasOwnProperty('message')){
        notice = $scope.resendResp.message;
        ncolor = "red";
      } else {
        notice = 'Envelope resent successfully';
      }
      $ngConfirm({
        title: '',
        content: notice,
        type: 'green',
        theme: 'material',
        closeIcon: true,
        backgroundDismiss: true
      });
      
      $scope.showRefresh = false;
    });
  };
  
  $scope.voidEnvelope = function(envID) {
    $http({
      method: "POST",
      url: "onboard/docusign_void.php",
      data: {
        id: userid,
        session_key: session_key,
        envID: envID
      },
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    }).then(function(response) {
      $scope.voidResp = response.data;
      console.log($scope.voidResp);
      
      var notice = "";
      var ncolor = "green";
      if($scope.voidResp.hasOwnProperty('message')){
        notice = $scope.voidResp.message;
        ncolor = "red";
      } else {
        notice = 'The envelope has been voided successfully';
      }
      
      $ngConfirm({
        title: '',
        content: notice,
        type: ncolor,
        theme: 'material',
        closeIcon: true,
        backgroundDismiss: true
      });
      
      $scope.showRefresh = false;
    });
  };
  
    Date.prototype.toIsoString = function() {
        var tzo = -this.getTimezoneOffset(),
            dif = tzo >= 0 ? '+' : '-',
            pad = function(num) {
                var norm = Math.floor(Math.abs(num));
                return (norm < 10 ? '0' : '') + norm;
            };
        return this.getFullYear() +
            '-' + pad(this.getMonth() + 1) +
            '-' + pad(this.getDate()) +
            'T' + pad(this.getHours()) +
            ':' + pad(this.getMinutes()) +
            ':' + pad(this.getSeconds()) +
            dif + pad(tzo / 60) +
            ':' + pad(tzo % 60);
    }

    $scope.convertTime = function(stime) {
        var d = new Date();
//         istTime = Date.parse(stime).addMinutes(200).addMinutes(-(d.getTimezoneOffset())).toISOString();
        istTime = Date.parse(stime+" EST").toIsoString();  
// 		  return Date.parse(stime).toISOString(); 
        
        return istTime; 
    };

    $scope.refreshStatus = function() {
    	$scope.showRefresh = true;
    	$scope.respData = '';
    	$scope.getAllRecords();
    };

    $scope.getAllRecords();
  
    $scope.empName= function(empID) {
      empService.getEmpDetails($scope, empID);
    }
    
    $scope.sendMailer = function(mailTo) {
      emailService.sendEmail($scope, mailTo);
    }
    
//     Message
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
        theme: 'material',
        closeIcon: true,
        icon: 'fa fa-check',
        backgroundDismiss: true
      });
    });
  }
  
  $scope.textUsAlert = '';
  $scope.respData = [];
  
  $scope.textBox = function(name, phone) {
    $scope.respData.name = name;
    $scope.respData.phone = phone;
    
    $ngConfirm({
      title: 'Text follow up with '+name,
      contentUrl: 'templates/text_us.html',
      scope: $scope,
      theme: 'material',
      type: 'green',
      icon: 'far fa-envelope',
      buttons: {
        cancel: {
          text: 'Cancel', 
          btnClass: 'btn btn-flat'
        },
        send: {
          text: 'Send', 
          action: function(){
              if ($scope.smsContent.length>140) {
                $scope.textUsAlert = 'Error: Text alert content more than 140 characters';
                
                return false;
              } else {
                $scope.textUsAlert = '';
                $scope.sendText();
              }
          },
          btnClass: 'btn btn-blue'
        }
      }
    });
  }

});