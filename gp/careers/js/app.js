var myApp = angular.module('gpCareers', ['ui.router', 'cp.ngConfirm', 'ngMessages', 'naif.base64', 'ui.select', 'ngSanitize']);

myApp.config(function($stateProvider, $urlRouterProvider) {
    $stateProvider.state('jobsBoard', {
        url: '/jobsBoard',
        templateUrl: 'listing.html'
    });

    $stateProvider.state('job', {
        url: '/job/:jobID',
        templateUrl: 'job.html'
    });
  
    $stateProvider.state('jobs', {
        url: '/jobs/:jobID',
        templateUrl: 'job.html'
    });

    $stateProvider.state('jobsAlert', {
        url: '/jobsAlert',
        templateUrl: 'alert.html'
    });
  
    $urlRouterProvider.rule(function ($injector, $location) {
        var path = $location.path(), normalized = path.toLowerCase();
        if (normalized.indexOf("/!/jobs") > -1) {
          var locArray = path.split('/');
          var acPath = '/jobs/'+locArray[locArray.length-1];
          $location.replace().path(acPath);
        }
    });
    
//     $urlRouterProvider.otherwise('/jobsBoard');
//     $urlRouterProvider.otherwise(function($injector, $location){
//        var state = $injector.get('$state');
//        state.go('jobs');
//        return $location.path();
//     });
//     $urlRouterProvider.when('/#/', '!/jobs/11368');
//     $urlRouterProvider.otherwise(function ($injector, $location) {
//         var path = $location.absUrl();
//         if (path.indexOf('_escaped_fragment_') === -1) {
//             return '/';
//         }
//     });
});

myApp.config(['$locationProvider', function($locationProvider) {
  $locationProvider.hashPrefix('');
//   $locationProvider.html5Mode(true);
}]);

myApp.run([
    '$ngConfirmDefaults',
    function($ngConfirmDefaults){
        $ngConfirmDefaults.theme = 'material';
        $ngConfirmDefaults.animation = 'top';
        $ngConfirmDefaults.closeAnimation = 'bottom';
    	$ngConfirmDefaults.columnClass = 'medium';
    }
]);

// angular.bootstrap(document.getElementById("router"), ['myApp']);