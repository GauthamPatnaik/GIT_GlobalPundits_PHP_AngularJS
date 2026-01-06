var app = angular.module('referralTrack', ['ngMessages', 'cp.ngConfirm']);

app.controller('trackReferralController', function($scope, $http, $ngConfirm) {
    $scope.disableBtn = false;
    $scope.message = "";
    $scope.img = "";

    $scope.bhid = "";

    $scope.trackReferral = function() {
        $scope.disableBtn = true;
        $scope.message = "Fetching details, please wait..."
        $scope.alertClass = "alert-block-yellow";

        $http({
            method: "POST",
            url: "referrals/test.php",
            data: {
                bh_id: $scope.bhid
            },
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        }).then(function(response) {
            console.log(response.data);
            $scope.disableBtn = false;

            if (response.data.status) {
                $scope.message = "Details fetched"
                $scope.alertClass = "alert-block-green";

                $scope.img = response.data.message;
            } else {
                $scope.message = response.data.message;
                $scope.alertClass = "alert-block-red";

                $scope.img = "";
            }
        });
    }
});