myAPP.factory('empService', function($http, $ngConfirm) {
  var myFactory = {};
  
  myFactory.getEmpDetails = function($scope, empID) {
          
    $ngConfirm({
      title: '',
      contentUrl: 'templates/qc_emp.html',
      type: 'blue',
      closeIcon: false,
      backgroundDismiss: true,
      theme: 'light',
      scope: $scope,
      onScopeReady: function(scope){
        
        $scope.empData = "";
        $http({
          method: "POST",
          url: "app/getEmpDetailsByID_api.php",
          data: {
            id: userid,
            session_key: session_key,
            sID: empID
          },
          headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        }).then(function(response) {
          $scope.empData = response.data;
//           console.log(response.data)
        });
        
      }
    });
  }
  
  return myFactory;
});

myAPP.factory('emailService', function($http, $ngConfirm) {
  var myFactory = {};
  
  myFactory.sendEmail = function($scope, sendTO = null) {
    
    $scope.mailCC = [];
    $scope.uploader = {};
    $scope.filesQueue = [];
    $scope.filesUploaded = [];
    
    $scope.mailTo = [];
    $scope.mailCC = [];
    $scope.mailBCC = [];
    $scope.showCC = false;
    $scope.showBCC = false;
    
    $scope.emailBody = "";
    $scope.mailSubject = "";
    
    if (sendTO != null) {
      var newVal={'text':sendTO};    
      $scope.mailTo.push(newVal);
    }
    
    $scope.toggleCC = function() {
      if ($scope.showCC) 
        $scope.showCC = false;
      else
        $scope.showCC = true;
    }
    $scope.toggleBCC = function() {
      if ($scope.showBCC) 
        $scope.showBCC = false;
      else
        $scope.showBCC = true;
    }
    
//     $scope.logIt = function() {
//       $scope.filesQueue = [];
//       $scope.filesUploaded = [];
//       for (i=0;i<$scope.uploader.flow.files.length;i++) {
//         $scope.filesQueue.push($scope.uploader.flow.files[i].name);
        
//         if ($scope.uploader.flow.files[i].hasOwnProperty('sname')) {
//           $scope.filesUploaded.push($scope.uploader.flow.files[i].sname);     
//         }
//       }
//       console.log($scope.filesQueue)
//       console.log($scope.filesUploaded)
//       console.log($scope.mailTo);
//       console.log($scope.emailBody);
//     };
    
    $scope.fileUploadSuccess = function( $file, $message, $flow ) {
      $message = JSON.parse($message);
      $file.sname = $message.file;
    };
          
    var mailerModal = $ngConfirm({
      title: '',
      contentUrl: 'templates/sendEmail_template.html?key='+Math.floor(Math.random()*90000) + 10000,
      type: 'blue',
      closeIcon: false,
      backgroundDismiss: false,
      theme: 'light',
      columnClass: 'l',
      scope: $scope,
      buttons: {
        Cancel: {
          text: 'Cancel',
            btnClass: 'btn-flat',
            action: function(scope, button){
              return true;
            }
        },
        Send: {
            text: 'Send',
            btnClass: 'btn-blue',
            action: function(scope, button){
              
              $scope.filesQueue = [];
              $scope.filesUploaded = [];
              for (i=0;i<$scope.uploader.flow.files.length;i++) {
                $scope.filesQueue.push($scope.uploader.flow.files[i].name);

                if ($scope.uploader.flow.files[i].hasOwnProperty('sname')) {
                  $scope.filesUploaded.push($scope.uploader.flow.files[i].sname);     
                }
                
              }
              if ($scope.filesQueue.length == $scope.filesUploaded.length) {
                $scope.emailBody += "<p><br></p><p><br></p><p><br>******************************************************************************************<br></p><p style='font-size= 6px; color: rgb(114, 114, 114);'>This email message and all attachments transmitted with it are for the sole use of the intended recipient(s) and may contain confidential and privileged information. Please DO NOT forward this email outside of the recipient's Company unless expressly authorized to do so herein.&nbsp; Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact the sender by reply email and destroy all copies of the original message.Any views expressed in this email message are those of the individual sender except where the sender specifically states them to be the views of Globalpundits.</p><p><br>*******************************************************************************************<br></p>";
                $scope.sendMail();
              } else {
                notie.alert({type: 2, text: 'Please wait, files are still uploading.', position: 'bottom', time: 2});
              }
              
              return false;
            }
        }
      },
    });
    
    $scope.sendMail = function() {
      $http({
	      method: "POST",
	      url: "mail_test.php",
	      data: {
	      	id: userid,
	      	session_key: session_key,
          to: $scope.mailTo,
          cc: $scope.mailCC,
          bcc: $scope.mailBCC,
          subject: $scope.mailSubject,
          body: $scope.emailBody,
          files: $scope.filesUploaded,
          fileNames: $scope.filesQueue,
	      },
	      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
	    }).then(function(response) {
	    	console.log(response.data);
        $scope.mailerResp = response.data;
        
        if ($scope.mailerResp.status) {
            var mailerConfirm = $ngConfirm({
              title: 'Email Sent',
              content: $scope.mailerResp.message,
              type: 'blue',
              closeIcon: false,
              backgroundDismiss: false,
              theme: 'light',
              scope: $scope,
              buttons: {
                hello: {
                    text: 'OK',
                    btnClass: 'btn-blue',
                    action: function(scope, button){
                      mailerModal.close();
                      return true;
                    }
                }
              },
            });
        } else {
          var mailerConfirm1 = $ngConfirm({
              title: 'Error',
              content: $scope.mailerResp.message,
              type: 'red',
              closeIcon: false,
              backgroundDismiss: false,
              theme: 'light',
              scope: $scope,
              buttons: {
                hello: {
                    text: 'OK',
                    btnClass: 'btn-blue',
                    action: function(scope, button){
                      return true;
                    }
                }
              },
            });
        }
        
	    });
    };
  }
  
  return myFactory;
});