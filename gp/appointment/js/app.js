var myApp = angular.module('myApp', ['ngMaterial', 'ngMessages', 'ui.router']);

myApp.config(function($provide, $mdThemingProvider) {
    $mdThemingProvider.theme('default')
        .primaryPalette('blue')
        .accentPalette('orange');

    $mdThemingProvider.generateThemesOnDemand(true);
    // $mdThemingProvider.alwaysWatchTheme(true);

    $provide.value('themeProvider', $mdThemingProvider);
});

myApp.config(function($stateProvider, $urlRouterProvider) {
    var mainState = {
        name: 'id',
        url: '/id/:id',
        templateUrl: 'main.html',
        params: {
            id: {squash: true, value: null}
        }
    }
  
    $stateProvider.state(mainState);
    $urlRouterProvider.otherwise('/id')
});

// myApp.config(function($mdDateLocaleProvider) {
//    $mdDateLocaleProvider.formatDate = function(date) {
//        return moment(date).format('YYYY-MM-DD');
//     };
// });



