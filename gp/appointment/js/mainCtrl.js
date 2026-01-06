myApp.controller('mainCtrl', function ($scope, $http, $stateParams) {
  $scope.startTime = '';
  $scope.endTime = '';
  $scope.localStartTime = '';
  $scope.localEndTime = '';
  $scope.freeData = [];

  $scope.selectedDate = false;
  $scope.showConfirm = false;
  $scope.showTimes = false;
  $scope.startDate = new Date();
  $scope.selectedIndex = 0;
  $scope.divClass = 'hideCol';
  $scope.localTimeZone = moment.tz.guess();

  $scope.minDate = new Date(
    $scope.startDate.getFullYear(),
    $scope.startDate.getMonth(),
    $scope.startDate.getDate()
  );
  $scope.maxDate = new Date(
    $scope.startDate.getFullYear(),
    $scope.startDate.getMonth(),
    $scope.startDate.getDate()+12
  );
  
  $scope.morningHours = [];
  $scope.noonHours = [];
  
  $scope.calendarClick = function() {
    sDate = moment($scope.startDate);
    cDate = moment();

    if (!sDate.isBefore(cDate) && $scope.startDate.getDay()!=0 && $scope.startDate.getDay()!=6) {
      $scope.divClass = 'col-lg';
      $scope.selectedDate=false; 
      $scope.checkFreeTime(); 
      $scope.showTimes = false
    }
  }

  $scope.onlyWeekdays = function(date) {
    var day = date.getDay();

    if (day === 0 || day === 6) {
      return false
    }
    return true;
  }

  $scope.selectDate = function(val) {
    var dateTime = moment($scope.startDate).format('YYYY-MM-DD')+' '+val;
    $scope.startTime = moment.tz(dateTime, 'YYYY-MM-DD h:mm', 'US/Eastern');
    $scope.endTime = moment($scope.startTime).add(29, 'minutes');

    $scope.localStartTime = $scope.startTime.tz($scope.localTimeZone).format('Do MMMM YYYY, hh:mm a');
    $scope.localEndTime = $scope.endTime.tz($scope.localTimeZone).format('Do MMMM YYYY, hh:mm a');
    $scope.selectedDate = true;
    $scope.selectedIndex = 1;
    console.log($scope.selectedDate);
  }
  
  $scope.moment = function(val) {
    return moment(val);
  }
  
  $scope.timeZone = function(a) {
    var formatedDate = moment($scope.startDate).format('YYYY-MM-DD')+' '+a;
    var formatedDate1 = moment.tz(formatedDate, 'YYYY-MM-DD hh:mm', 'US/Eastern');
    var time = formatedDate1.tz($scope.localTimeZone).format('hh:mm a');
    return time;
  }

  $scope.getAppData = function() {
    $http({
      method: "POST",
      url: "https://globalpundits.com/appointment/app/fetchApp.php",
      data: {
        appID: $scope.id
      },
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    }).then(function(response) {
      $scope.resData = response.data;
      console.log(response.data);
    });
  }

  $scope.checkFreeTime = function() {
    $http({
      method: "POST",
      url: "https://globalpundits.com/appointment/app/checkFree.php",
      data: {
        appID: $scope.id,
        minTime: moment($scope.startDate).format('YYYY-MM-DD')+'T08:00:00'+moment($scope.startDate).tz("US/Eastern").format('Z'),
        maxTime: moment($scope.startDate).format('YYYY-MM-DD')+'T19:00:00'+moment($scope.startDate).tz("US/Eastern").format('Z')
      },
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    }).then(function(response) {
      $scope.showTimes = true;
      $scope.freeData = response.data;

      $scope.morningHours = [];
      $scope.noonHours = [];
      $scope.availableStart = '08:00:00';
      $scope.availableEnd = '15:00:00';
      timeStart = moment(moment($scope.startDate).format('YYYY-MM-DD')+' '+$scope.availableStart);
      timeEnd = moment(moment($scope.startDate).format('YYYY-MM-DD')+' '+$scope.availableEnd);
      for (i=0;i<9;i++) {
        $scope.morningHours.push(moment(timeStart).add(i*30, 'minutes').format('HH:mm'));
        $scope.noonHours.push(moment(timeEnd).add(i*30, 'minutes').format('HH:mm'));
      }
      console.log(response.data);
    });
  }

  if ($stateParams.id) {
    $scope.id = $stateParams.id;

    $scope.getAppData();
  }

  $scope.fixAppointment = function() {
    $scope.showConfirm = true;
    $scope.selectedIndex = 2;
  }

  $scope.checkBusy = function(val) {
    var formatedDate = moment($scope.startDate).format('YYYY-MM-DD')+' '+val;
    var formatedDate1 = moment.tz(formatedDate, 'YYYY-MM-DD hh:mm', 'US/Eastern');
    
    if (formatedDate1.isBefore(moment())) {
      return true
    }
    if ($scope.freeData.length>0) {
      
      for (i=0;i<$scope.freeData.length;i++) {
        var busyStart = moment($scope.freeData[i]['start']).add(-1, 'minutes');
        var busyEnd = moment($scope.freeData[i]['end']).add(1, 'minutes');   
        
        if (formatedDate1.isBetween(busyStart, busyEnd) || formatedDate1 == busyStart || formatedDate1 == busyEnd) {
          return true
        }
      }
    }
    return false;
  }

  $scope.setApp = function() {
    $http({
      method: "POST",
      url: "https://globalpundits.com/appointment/app/setApp.php",
      data: {
        appID: $scope.id,
        start: $scope.startTime.toISOString(),
        end: $scope.endTime.toISOString(),
        questions: $scope.resData[0].questions
      },
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    }).then(function(response) {
      
      console.log(response.data);
    });
  }
});