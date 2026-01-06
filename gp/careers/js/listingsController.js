myApp.controller('listingsController', function($scope, $http, $sce) {
    $scope.title = 'Testing Header';

    $scope.cardStyle = "col-lg-12";

    $scope.getOpenJobs = function() {
        $http({
            method: "GET",
            url: "app/fetch_jobs.php",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        }).then(function(response) {
            $scope.data = response.data;
            console.log(response.data);

            $scope.initFilters();
            sessionStorage.setItem('openJobs', JSON.stringify($scope.data));
            var date = new Date();
            date.setTime(date.getTime() + (5*60*1000));
//             $.cookie("listingSession", "active", { expires: date });
            document.cookie = "listingSession=active; expires="+date.toGMTString()+"; path=/";
        });
    }

    $scope.getIndex = function(jobID) {
        for (i=0;i<$scope.data.length;i++) {
            if ($scope.data[i].id == jobID) {
                return '-'+i;
            }
        }
    }

    $scope.sanitizeHTML = function(html) {
        if (html==null) {
            html = "";
        }
        return $sce.trustAsHtml(html.substring(0,150).replace(/(<([^>]+)>)/ig,"")+'...');
    } 

    $scope.locations = {};
    $scope.categories = {};
    $scope.jobs = {};

    $scope.activeLocations = [];
    $scope.activeCategories = [];
    $scope.activeJobs = [];

    $scope.obejctToArray = function(obj, obj1) {
        angular.forEach(obj, function(value, key) {
            obj1.push({
                name: key,
                count: value
            });
        });
    }

    $scope.initFilters = function() {
        $scope.locations = {};
        $scope.categories = {};
        $scope.jobs = {};

        $scope.locations1 = [];
        $scope.categories1 = [];
        $scope.jobs1 = [];
        $scope.limit = 10;

        for (i=0;i<$scope.data.length;i++) {
            var loc = $scope.data[i].city+', '+$scope.data[i].state;

            //Category
            if (!$scope.data[i].publishedCategory) {
              $scope.data[i].publishedCategory = 'Other Area(s)';
            }

            //Job
            if (!$scope.data[i].jobCategory) {
                $scope.data[i].jobCategory = 'Other Area(s)';
            }
            
            //Object init
            if ($scope.data[i].publishedCategory in $scope.categories) {
                $scope.categories[$scope.data[i].publishedCategory] = $scope.categories[$scope.data[i].publishedCategory] + 1;
            } else {
                $scope.categories[$scope.data[i].publishedCategory] = 1;
            }

            if ($scope.data[i].jobCategory in $scope.jobs) {
                $scope.jobs[$scope.data[i].jobCategory] = $scope.jobs[$scope.data[i].jobCategory] + 1;
            } else {
                $scope.jobs[$scope.data[i].jobCategory] = 1;
            }

            if (loc in $scope.locations) {
                $scope.locations[loc] = $scope.locations[loc] + 1;
            } else {
                $scope.locations[loc] = 1;
            }
            
        }

        $scope.obejctToArray($scope.jobs, $scope.jobs1);
        $scope.obejctToArray($scope.categories, $scope.categories1);
        $scope.obejctToArray($scope.locations, $scope.locations1);
    }

    $scope.selectFilter = function(key, filter) {
        if (filter.indexOf(key) == -1 ) {
            filter.push(key);
        } else {
            var index = filter.indexOf(key);
            filter.splice(index, 1);
        }
        $scope.limit = 50;
        // console.log(filter);
    }

    $scope.isActive = function(key, filter) {
        if (filter.indexOf(key) == -1 ) {
            return false;
        }
        
        return true;
    }

    $scope.jobFilter = function(job) {
        var catFlag = $scope.activeCategories.length == 0 || $scope.activeCategories.indexOf(job.publishedCategory) != -1;
        var jobFlag = $scope.activeJobs.length == 0 || $scope.activeJobs.indexOf(job.jobCategory) != -1;
        var locFlag = $scope.activeLocations.length == 0 || $scope.activeLocations.indexOf(job.city+', '+job.state) != -1;
        
        // console.log(catFlag+' - '+jobFlag+' - '+locFlag);
        // console.log($scope.activeJobs.indexOf(job.jobFilter) != -1)

        if (catFlag && jobFlag && locFlag) {
            return true;
        }
        return false;
    }

    $scope.reInitFilter = function(key) {

        if (key=='cat') {
            $scope.locations = {};
            $scope.jobs = {};
        } else if (key=='job') {
            $scope.locations = {};
            $scope.categories = {};
        } else {
            $scope.categories = {};
            $scope.jobs = {};
        }
        
        for (i=0;i<$scope.data.length;i++) {
            var loc = $scope.data[i].city+', '+$scope.data[i].state;

            if (key == 'cat') {
                
                if ($scope.activeCategories.indexOf($scope.data[i].publishedCategory) != -1 || $scope.activeCategories.length == 0) {
                    if ($scope.data[i].jobCategory in $scope.jobs) {
                        $scope.jobs[$scope.data[i].jobCategory] = $scope.jobs[$scope.data[i].jobCategory] + 1;
                    } else {
                        $scope.jobs[$scope.data[i].jobCategory] = 1;
                    }

                    if (loc in $scope.locations) {
                        $scope.locations[loc] = $scope.locations[loc] + 1;
                    } else {
                        $scope.locations[loc] = 1;
                    }
                }
            }

            if (key == 'job') {
                
                if ($scope.activeJobs.indexOf($scope.data[i].jobCategory) != -1 || $scope.activeJobs.length == 0) {
                    if ($scope.data[i].publishedCategory in $scope.categories) {
                        $scope.categories[$scope.data[i].publishedCategory] = $scope.categories[$scope.data[i].publishedCategory] + 1;
                    } else {
                        $scope.categories[$scope.data[i].publishedCategory] = 1;
                    }

                    if (loc in $scope.locations) {
                        $scope.locations[loc] = $scope.locations[loc] + 1;
                    } else {
                        $scope.locations[loc] = 1;
                    }
                }
            }

            if (key == 'loc') {
                
                if ($scope.activeLocations.indexOf(loc) != -1 || $scope.activeLocations.length == 0) {
                    if ($scope.data[i].publishedCategory in $scope.categories) {
                        $scope.categories[$scope.data[i].publishedCategory] = $scope.categories[$scope.data[i].publishedCategory] + 1;
                    } else {
                        $scope.categories[$scope.data[i].publishedCategory] = 1;
                    }

                    if ($scope.data[i].jobCategory in $scope.jobs) {
                        $scope.jobs[$scope.data[i].jobCategory] = $scope.jobs[$scope.data[i].jobCategory] + 1;
                    } else {
                        $scope.jobs[$scope.data[i].jobCategory] = 1;
                    }
                }
            }

            
        }
        $scope.jobs1 = [];
        $scope.obejctToArray($scope.jobs, $scope.jobs1);

        $scope.categories1 = [];
        $scope.obejctToArray($scope.categories, $scope.categories1);

        $scope.locations1 = [];
        $scope.obejctToArray($scope.locations, $scope.locations1);
    }

    $scope.search = '';
    $scope.searchInit = function() {
        if ($scope.search!='') {
            $scope.limit = $scope.data.length;
            // alert('bazzinga')
        } else {
            $scope.limit = 10;
            $scope.loadButton = "Load more";
        }

        $scope.loadMore();
    }

    $scope.searchFilterFn = function(job) {
        if ($scope.search == '') {
            return true;
        }
        if (job.title.toLowerCase().indexOf($scope.search.toLowerCase()) > -1 ) {
            // $scope.limit = 50;
            return true;
        }

        return false;
    }
    
    $scope.limit = 10;
    $scope.loadButton = 'Load More'

    $scope.loadMore = function() {
        // alert($scope.limit)
        if ($scope.data.length<$scope.limit) {
            $scope.loadButton = "That's all folks!";
        } else {
            $scope.limit += 10;
            if ($scope.data.length<$scope.limit) {
                $scope.loadButton = "That's all folks!";
            }
        }
    }

    $scope.showMoreButton = function(obj) {
        var size = 0;
        for (var property in obj) {
            if (Object.prototype.hasOwnProperty.call(obj, property)) {
                size++;
            }
        }

        if (size>5) {
            return true;
        } else {
            return false;
        }
    }

    if (sessionStorage.openJobs == null || document.cookie.indexOf('listingSession') == -1) {
        console.log('init');
        $scope.getOpenJobs();
    } else {
        // console.log(localStorage.getItem('openJobs'))
        $scope.data = JSON.parse(sessionStorage.getItem('openJobs'));
        $scope.initFilters();
    }

    var catClick = 0;
    $('#catFilterMore').click(function() {
        if (catClick==0) {
            TweenMax.to("#catFilter", 0.5, {maxHeight: 1200, ease: Power1.easeInOut});
            document.getElementById('catFilterMore').innerHTML = 'See less';

            catClick = 1
        } else {
            TweenMax.to("#catFilter", 0.5, {maxHeight: 160, ease: Power1.easeInOut});
            document.getElementById('catFilterMore').innerHTML = 'See more';

            catClick = 0
        }
    });

    var locClick = 0;
    $('#locFilterMore').click(function() {
        if (locClick==0) {
            TweenMax.to("#locFilter", 0.5, {maxHeight: 1200, ease: Power1.easeInOut});
            document.getElementById('locFilterMore').innerHTML = 'See less';

            locClick = 1
        } else {
            TweenMax.to("#locFilter", 0.5, {maxHeight: 160, ease: Power1.easeInOut});
            document.getElementById('locFilterMore').innerHTML = 'See more';

            locClick = 0
        }
    });

    var jobClick = 0;
    $('#jobFilterMore').click(function() {
        if (jobClick==0) {
            TweenMax.to("#jobFilter", 0.5, {maxHeight: 1200, ease: Power1.easeInOut});
            document.getElementById('jobFilterMore').innerHTML = 'See less';

            jobClick = 1
        } else {
            TweenMax.to("#jobFilter", 0.5, {maxHeight: 160, ease: Power1.easeInOut});
            document.getElementById('jobFilterMore').innerHTML = 'See more';

            jobClick = 0
        }
    });

    $('#filters-section').css({
        'max-width': '0px',
        'min-width': '0px'
    }),

    $("#filterMobBtn").click(function() {
        var btnLeft = $("#filters-section").css('left');
        
        if (btnLeft=='-300px') {
            TweenMax.to("#filters-section", 0.5, {left:0});
            TweenMax.to("#filterMobBtn", 0.5, {left:300});

            $("#filterMobBtn").html('close');
        } else {
            TweenMax.to("#filters-section", 0.5, {left:-300});
            TweenMax.to("#filterMobBtn", 0.5, {left:0});

            $("#filterMobBtn").html('Filters');
        }
        
    });
    TweenMax.to("#filters-section", 0.5, {maxWidth: "300px", minWidth: "300px", padding: "0px", ease: Power1.easeInOut});
    TweenMax.from("#top-block", 0.5, {minHeight: 300, ease: Power1.easeInOut});
});