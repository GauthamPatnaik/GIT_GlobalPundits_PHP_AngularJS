myApp.controller('indexCtrl', function ($scope, $mdSidenav, themeProvider, $mdTheming, $mdMedia) {
    $scope.darkMode = false;


    if (getCookie('darkMode')!=null) {
        $scope.darkMode = getCookie('darkMode');

        if ($scope.darkMode) {
            themeProvider.theme('default')
                // .primaryPalette('purple')
                // .accentPalette('green')
                .dark();    
            $mdTheming.generateTheme('default');
        } else {
            themeProvider.theme('default');    
            $mdTheming.generateTheme('default');
        }
    } else {
        themeProvider.theme('default');    
        $mdTheming.generateTheme('default');
    }

    $scope.darkTheme = function() {
        if (!$scope.darkMode) {
            $scope.darkMode = true;
            setCookie('darkMode', $scope.darkMode, 365);
        } else {
            $scope.darkMode = false;
            setCookie('darkMode', $scope.darkMode, 365);
        }
        location.reload();
    }

});