myAPP.controller('reportController', function($scope, $http, $ocLazyLoad, DTOptionsBuilder, DTColumnBuilder) {

  $scope.upd_bhid = "";  

  

  $scope.referralData = function() {

		$http({

	      method: "GET",

	      url: "https://reports.globalpundits.com/home/websiteapi",

	      data: {

	      	id: userid,

          type: 'getRecords',

	      	session_key: session_key

	      },

	      headers: {'Content-Type': 'application/x-www-form-urlencoded'},

	    }).then(function(response) {

	    	$scope.referralRecords = response.data;	    	

	    });

	}

  $scope.referralData();

  

  $scope.dtOptions = DTOptionsBuilder.fromSource('data.json')

      .withPaginationType('full_numbers');

  $scope.dtColumns = [       

    DTColumnBuilder.newColumn('Name').withTitle('Name'),

    DTColumnBuilder.newColumn('BH_Id').withTitle('BH_Id'),

    DTColumnBuilder.newColumn('Phone').withTitle('Phone'),

    DTColumnBuilder.newColumn('Email').withTitle('Email'),

    DTColumnBuilder.newColumn('Gender').withTitle('Gender'),

    DTColumnBuilder.newColumn('Ethnicity').withTitle('Ethnicity'),

    DTColumnBuilder.newColumn('Veteran').withTitle('Veteran'),

    DTColumnBuilder.newColumn('Disability').withTitle('Disability'),

    DTColumnBuilder.newColumn('Occupication').withTitle('Occupication'),

    DTColumnBuilder.newColumn('EeoJobCat').withTitle('EeoJobCat'),

    DTColumnBuilder.newColumn('PublishedCategory').withTitle('PublishedCategory'), 

    DTColumnBuilder.newColumn('CurrentPositon').withTitle('CurrentPositon'),

    DTColumnBuilder.newColumn('CurrentLocation').withTitle('CurrentLocation'),

    DTColumnBuilder.newColumn('CurrentEst').withTitle('CurrentEst'),

    DTColumnBuilder.newColumn('DateHired').withTitle('DateHired'),

    DTColumnBuilder.newColumn('TermDate').withTitle('TermDate'),

    DTColumnBuilder.newColumn('FlsaStatus').withTitle('FlsaStatus'),

    DTColumnBuilder.newColumn('Salary').withTitle('Salary'), 

    DTColumnBuilder.newColumn('SalaryUnit').withTitle('SalaryUnit'),

    DTColumnBuilder.newColumn('JobSubmissionStatus').withTitle('JobSubmissionStatus'),

    DTColumnBuilder.newColumn('PlacementStatus').withTitle('CurrePlacementStatusntEst'),

    DTColumnBuilder.newColumn('DateAdded').withTitle('DateAdded').withOption('type', 'Antt-date')

  ];

  

  

  $("#excelExport").click(function(){

	  $("#referralTable").table2excel({

	    exclude: "",

	    name: "Candidates Report",

	    filename: "Candidates-Report.xls"

	  });

	});



  jQuery.extend( jQuery.fn.dataTableExt.oSort, {

    "Antt-date-pre": function ( a ) {

       if (a == null || a == '') {

         return 0;

       }

       var date = a.split('/');

       return Date.parse(date[0] + '/' + date[1] + '/' + date[2])

     }

   });



});



