myApp.controller('jobController', function($scope, $http, $stateParams, $sce, $ngConfirm) {
    $scope.jobID = $stateParams.jobID;
    $scope.applyForm = {};
    $scope.fileName = "Upload resume"
    $scope.fileUpload = null;

    $scope.addStructured = function(job) {
        var el = document.createElement('script');
        el.type = 'application/ld+json';
        var jsonData = {
            "@context" : "http://schema.org/",
            "@type" : "JobPosting",
            "title" : job.title,
            "description" : job.publicDescription,
            "identifier": {
              "@type": "PropertyValue",
              "name": "Globalpundits, Inc.",
              "value": job.id
            },
            "datePosted" : job.dateAdded,
            "validThrough" : job.dateEnd,
            "employmentType" : "CONTRACTOR",
            "hiringOrganization" : {
              "@type" : "Organization",
              "name" : "Globalpundits, Inc.",
              "sameAs" : "http://www.globalpundits.com",
              "logo" : "http://www.globalpundits.com/images/logo.png"
            },
            "jobLocation" : {
              "@type" : "Place",
              "address" : {
                "@type" : "PostalAddress",
                "streetAddress" : job.address1,
                "addressLocality" : job.city,
                "addressRegion" : job.state,
                "postalCode" : job.zip,
                "addressCountry": "US"
              }
            }
          };
        el.text = JSON.stringify(jsonData);
        document.querySelector('body').appendChild(el);
    }

    $scope.getJob = function(jobID) {
        $('html, body').animate({
            scrollTop: $("#top-block").offset().top
        }, 500);
        
        $scope.job = {};
        $scope.job.publicDescription = 'Loading'
        $http({
            method: "POST",
            data: {
                id: jobID
            },
            url: "app/fetch_job.php",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        }).then(function(response) {
            $scope.job = response.data['job'][0];
            console.log($scope.job);
            $scope.similar = response.data['similar'];
            $scope.jobIndex[0] = jobID;

            if ($scope.job.publicDescription == null || $scope.job.publicDescription === '' || !$scope.job.publicDescription) {
              if ($scope.job.description) {
                $scope.job.publicDescription = $scope.job.description;
              } else {
                $scope.job.publicDescription = "Description not available";
              }
            }
            if ($scope.job.publishedCategory==null || $scope.job.publishedCategory==='' || !$scope.job.publishedCategory) {
                $scope.job.publishedCategory = "Other Area(s) ";
            }
            console.log(response.data);

            $scope.addStructured($scope.job);
            $.holdReady(true);
            console.log(document.body.innerHTML);
        });
    }

    $scope.sendJob = function() {
        $http({
            method: "POST",
            data: {
                form: $scope.applyForm
            },
            url: "https://www.globalpundits.com/careers/app/apply_job.php",
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        }).then(function(response) {
            console.log(response.data);

            sending.close();

            $ngConfirm({
                title: '',
                content: '<div class="container"><br><br>'+response.data+'</div>',
                theme: 'material',
                columnClass: 'small',
                type: 'green'
            });

            $scope.applyForm = {};
            $scope.fileUpload = {};
            $scope.fileName = "Upload resume";
            jobPopup.close();

        }).catch(function (response) {
            sending.close();

            $ngConfirm({
                title: '',
                content: '<div class="container"><br><br>'+response.data+'</div>',
                theme: 'material',
                columnClass: 'small',
                type: 'red'
            });

            console.clear();
            console.log(response);
        });
    }

    // console.log(localStorage.getItem('openJobs'))
    if (sessionStorage.getItem('openJobs')==null || $scope.jobID.indexOf('-')===-1) {
        $scope.jobIndex = $scope.jobID.split('-');
        
        $.holdReady(false);
        $scope.getJob($scope.jobIndex[0]);
    } else {
        $scope.jobIndex = $scope.jobID.split('-');
        $scope.openJobs = JSON.parse(sessionStorage.getItem('openJobs'));

        $scope.job = $scope.openJobs[$scope.jobIndex[1]];
      
        if ($scope.job.publicDescription==null || $scope.job.publicDescription==='' || !$scope.job.publicDescription) {
          if ($scope.job.description!=null || $scope.job.description!=='') {
            $scope.job.publicDescription = $scope.job.description;
          } else { 
            $scope.job.publicDescription = "Description not available";
          }
        }
        
        if ($scope.job.publishedCategory==null || $scope.job.publishedCategory==='' || !$scope.job.publishedCategory) {
            $scope.job.publishedCategory = "Other Area(s) ";
        }

        $scope.similar = [];
        for (i=0;i<$scope.openJobs.length;i++) {
            var sim = [];
            if ($scope.job['publishedCategory']==$scope.openJobs[i]['publishedCategory'] && $scope.job['id']!=$scope.openJobs[i]['id']) {
                sim['id'] = $scope.openJobs[i]['id'];
                sim['title'] = $scope.openJobs[i]['title'];
                sim['state'] = $scope.openJobs[i]['state'];
                sim['city'] = $scope.openJobs[i]['city'];

                $scope.similar.push(sim);
            }
            if ($scope.similar.length==5) {
                break;
            }
        }
        console.log($scope.similar)

        $scope.addStructured($scope.job)
        console.log(document.body.innerHTML);
    }

    $scope.sanitizeHTML = function(html) {
        if (html==null) {
            html = "Loading...";
        }
        return $sce.trustAsHtml(html);
    }

    $scope.jobSubmit = function() {
//         console.log($scope.fileUpload);
        if ($scope.fileUpload==null) {
            console.clear();
            $scope.fileName = 'Please select a valid resume file';
        } else if ($scope.applyForm.firstName == null || $scope.applyForm.lastName == null || $scope.applyForm.mail == null ||  $scope.applyForm.phone == null) {
            $scope.fileName = 'All fields are mandatory, please check again';
        } else {

            if ($scope.fileUpload.filesize > 12*1024*1024) {
                $scope.fileName = 'Please select a valid resume file';
                $scope.fileUpload = null;
            } else {
                $scope.applyForm.file = $scope.fileUpload;
                
                if ($scope.jobID.includes("-")) {
                  $scope.jobIndex = $scope.jobID.split('-');
                  $scope.applyForm.jobID = $scope.jobIndex[0];
                } else {
                  $scope.applyForm.jobID = $scope.jobID;
                }
                

                console.clear();
                console.log($scope.applyForm);  
                sending = $ngConfirm({
                    title: '',
                    content: '<div class="container"><br>Submitting application for job ID '+$scope.jobID+'</div>',
                    theme: 'material',
                    closeIcon: false,
                    type: 'blue',
                    columnClass: 'small'
                });
                $scope.sendJob();
            }

        }
    }

    $scope.fileSuccess = function (event, reader, file, fileList, fileObjs, object) {
        console.clear()
        console.log(file);
        if (file.size > 12*1024*1024) {
            $scope.fileName = 'File size cannot be greater than 12 MB';
        }else {
            $scope.fileName = file.name;
        }
    };

    $scope.fileError = function(event, reader, file, fileList, fileObjs, object) {
        $scope.fileName = 'Error uploading file, please try again!';
        $scope.fileUpload = null;
    };

    $scope.applyJob = function() {
        jobPopup = $ngConfirm({
            title: '',
            contentUrl: 'applyJob_template.html?v='+Math.round(Math.random()*100000),
            scope: $scope,
            backgroundDismiss: true,
        });
    }

    $('html, body').animate({
        scrollTop: $("#top-block").offset().top
    }, 500);
    
    TweenMax.to("#filters-section", 0.5, {maxWidth: "0px", minWidth: "0px", padding: "0px", marginLeft: "-35px", ease: Power1.easeInOut});
    TweenMax.to("#top-block", 0.7, {maxHeight: 600, ease: Power1.easeInOut});
    TweenMax.to("#content-section", 0.3, {backgroundColor: '#fff', ease: Power1.easeInOut});
});