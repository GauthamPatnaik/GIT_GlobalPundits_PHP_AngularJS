var app = angular.module('referrals', ['ngMessages', 'cp.ngConfirm']);

app.controller('referralController', function($scope, $http, $ngConfirm) {
    $scope.formData = {};
    $scope.disableBtn = false;
    $scope.message = "";
    $scope.alertClass = "";

    $scope.show = function() {
        console.log($scope.formData);
        var errors = Object.keys($scope.referralForm.$error);
        console.log(errors.length);
    }

    $scope.showTerms = function() {
        $ngConfirm({
            title: 'Terms & Conditions',
            content: 'Referred candidates already listed in Globalpundits’s database will not receive payment or a tracking number. Referred consultants must be fully employed and active within One (1) Year of said consultants’ referral to Globalpundits, and employed for a minimum of sixty (60) days for any 5 payment to be made. To receive payment, a Referrer must <br/>a) be a US Resident as described by applicable federal guidelines and <br/>b) complete, sign, and email the IRS W-9 tax form, available at <a style="color: blue;" href="https://www.irs.gov/pub/irs-pdf/fw9.pdf" target="_blank">https://www.irs.gov/pub/irs-pdf/fw9.pdf',
            type: 'blue',
            columnClass: 'xlarge',
            backgroundDismiss: true,
            animation: 'top',
            closeAnimation: 'top',
            theme: 'material'
        });
    }

    $scope.submitForm = function() {
        // console.log($scope.formData);
        $scope.disableBtn = true;
        $scope.message = "Submitting details";
        $scope.alertClass = "alert-block-yellow";

        $http({
            method: "POST",
            url: "referrals/submitReferral.php",
            data: {
                fields: $scope.formData
            },
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        }).then(function(response) {
            console.log(response.data);
            $scope.disableBtn = false;

            if (response.data.status) {
                $scope.alertClass = "alert-block-green";
                $scope.message = response.data.message;
            } else {
                $scope.alertClass = "alert-block-red";
                $scope.message = response.data.message;
            }
        });
    }
});