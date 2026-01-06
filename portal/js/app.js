var app = angular.module('navProfile', []);

var myAPP = angular.module('myAPP', ['ui.router', 'textAngular', 'oc.lazyLoad', 'cp.ngConfirm', 'angular-loading-bar', 'datatables', 'angularTrix', 'ngTagsInput', 'flow']);

myAPP.run([
    '$ngConfirmDefaults',
    function($ngConfirmDefaults){
      $ngConfirmDefaults.theme = 'supervan';
      $ngConfirmDefaults.animation = 'top';
    	$ngConfirmDefaults.closeAnimation = 'bottom';
    	$ngConfirmDefaults.columnClass = 'medium';
    }
]);

myAPP.config(['cfpLoadingBarProvider', function(cfpLoadingBarProvider) {
    cfpLoadingBarProvider.includeSpinner = false;
}]);

myAPP.config(['flowFactoryProvider', function (flowFactoryProvider) {
    flowFactoryProvider.defaults = {
        target: 'uploader.php',
        permanentErrors:[404, 500, 501],
        simultaneousUploads: 4
    };
}]);

myAPP.config(['$provide', function($provide){
		$provide.decorator('taOptions', ['$delegate', function(taOptions){
			taOptions.toolbar = [
				['h1', 'h2', 'h3', 'h4', 'p', 'pre', 'bold', 'italics', 'underline', 'ul', 'ol', 'redo', 'undo'],
				['justifyLeft','justifyCenter','justifyRight', 'justifyFull'],
				['html', 'insertImage', 'insertLink']
			];
			taOptions.classes = {
				focussed: 'focussed',
				toolbar: 'btn-toolbar',
				toolbarGroup: 'btn-group',
				toolbarButton: 'btn btn-default',
				toolbarButtonActive: 'active-toolbar',
				disabled: 'disabled',
				textEditor: 'form-control',
				htmlEditor: 'form-control'
			};
			return taOptions; // whatever you return will be the taOptions
		}]);
		// this demonstrates changing the classes of the icons for the tools for font-awesome v3.x
// 		$provide.decorator('taTools', ['$delegate', function(taTools){
// 			taTools.bold.iconclass = 'icon-bold';
// 			taTools.italics.iconclass = 'icon-italic';
// 			taTools.underline.iconclass = 'icon-underline';
// 			taTools.ul.iconclass = 'icon-list-ul';
// 			taTools.ol.iconclass = 'icon-list-ol';
// 			taTools.undo.iconclass = 'icon-undo';
// 			taTools.redo.iconclass = 'icon-repeat';
// 			taTools.justifyLeft.iconclass = 'icon-align-left';
// 			taTools.justifyRight.iconclass = 'icon-align-right';
// 			taTools.justifyCenter.iconclass = 'icon-align-center';
// 			taTools.clear.iconclass = 'icon-ban-circle';
// 			taTools.insertLink.iconclass = 'icon-link';
// 			taTools.insertImage.iconclass = 'icon-picture';
// 			// there is no quote icon in old font-awesome so we change to text as follows
// 			delete taTools.quote.iconclass;
// 			taTools.quote.buttontext = 'quote';
// 			return taTools;
// 		}]);
      $provide.decorator('taTools', ['$delegate', function(taTools){
        taTools.redo.iconclass = 'fas fa-redo';
        taTools.insertImage.iconclass = 'fas fa-image';
        return taTools;
      }]);
	}]);
