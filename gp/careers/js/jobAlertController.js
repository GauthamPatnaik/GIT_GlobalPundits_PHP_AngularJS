myApp.controller('jobAlertController', function($scope, $http, $ngConfirm) {
    $scope.packet = {};
        
    $scope.jobFilterAll = [
        {
            "id": "1",
            "name": "Project Manager",
            "catID": "1",
            "catName": "Information Technology"
        },
        {
            "id": "2",
            "name": "Business Analyst",
            "catID": "1",
            "catName": "Information Technology"
        },
        {
            "id": "3",
            "name": "Network Engineer/Analyst",
            "catID": "1",
            "catName": "Information Technology"
        },
        {
            "id": "4",
            "name": "Security Risk Analyst",
            "catID": "1",
            "catName": "Information Technology"
        },
        {
            "id": "5",
            "name": "DataBase Administrator",
            "catID": "1",
            "catName": "Information Technology"
        },
        {
            "id": "6",
            "name": "System / Server Administrator",
            "catID": "1",
            "catName": "Information Technology"
        },
        {
            "id": "7",
            "name": "Quality Assurance/Testing",
            "catID": "1",
            "catName": "Information Technology"
        },
        {
            "id": "8",
            "name": "Data Analyst",
            "catID": "1",
            "catName": "Information Technology"
        },
        {
            "id": "9",
            "name": "Identity/ Access Management",
            "catID": "1",
            "catName": "Information Technology"
        },
        {
            "id": "10",
            "name": "IT Asset Management",
            "catID": "1",
            "catName": "Information Technology"
        },
        {
            "id": "11",
            "name": "Statistical Programming Analyst",
            "catID": "1",
            "catName": "Information Technology"
        },
        {
            "id": "12",
            "name": "Desktop Support",
            "catID": "1",
            "catName": "Information Technology"
        },
        {
            "id": "13",
            "name": "IT Auditor",
            "catID": "1",
            "catName": "Information Technology"
        },
        {
            "id": "14",
            "name": "IT Vendor / Contracts Admin",
            "catID": "1",
            "catName": "Information Technology"
        },
        {
            "id": "15",
            "name": "Software Programmer/ Developer/Engineer/Architect",
            "catID": "1",
            "catName": "Information Technology"
        },
        {
            "id": "16",
            "name": "Project Manager",
            "catID": "2",
            "catName": "Project Management"
        },
        {
            "id": "17",
            "name": "Project Coordinator/Specialist",
            "catID": "2",
            "catName": "Project Management"
        },
        {
            "id": "18",
            "name": "Architect",
            "catID": "3",
            "catName": "Engineering"
        },
        {
            "id": "19",
            "name": "Electrical & I&C Engineer",
            "catID": "3",
            "catName": "Engineering"
        },
        {
            "id": "20",
            "name": "Mechanical Engineer",
            "catID": "3",
            "catName": "Engineering"
        },
        {
            "id": "21",
            "name": "Civil/Structural Engineer",
            "catID": "3",
            "catName": "Engineering"
        },
        {
            "id": "22",
            "name": "Fire Protection Engineer",
            "catID": "3",
            "catName": "Engineering"
        },
        {
            "id": "23",
            "name": "Nuclear Safety Engineer",
            "catID": "3",
            "catName": "Engineering"
        },
        {
            "id": "24",
            "name": "Work Control Planner",
            "catID": "3",
            "catName": "Engineering"
        },
        {
            "id": "25",
            "name": "Construction Field Engineer",
            "catID": "3",
            "catName": "Engineering"
        },
        {
            "id": "26",
            "name": "CONTAM software",
            "catID": "3",
            "catName": "Engineering"
        },
        {
            "id": "27",
            "name": "Project Controls",
            "catID": "3",
            "catName": "Engineering"
        },
        {
            "id": "28",
            "name": "Designer",
            "catID": "3",
            "catName": "Engineering"
        },
        {
            "id": "29",
            "name": "Manufacturing Engineer",
            "catID": "3",
            "catName": "Engineering"
        },
        {
            "id": "30",
            "name": "Recruiter",
            "catID": "4",
            "catName": "Other"
        },
        {
            "id": "31",
            "name": "Technical Writer",
            "catID": "4",
            "catName": "Other"
        },
        {
            "id": "32",
            "name": "Accounting",
            "catID": "4",
            "catName": "Other"
        },
        {
            "id": "33",
            "name": "Training",
            "catID": "4",
            "catName": "Other"
        },
        {
            "id": "34",
            "name": "Sales",
            "catID": "4",
            "catName": "Other"
        }
    ];

    $scope.jobFilter = [];

    $scope.categoryFilter = [
        {'id': 1, 'name': 'Information Technology'},
        {'id': 2, 'name': 'Project Management'},
        {'id': 3, 'name': 'Engineering'},
        {'id': 4, 'name': 'Others'}
    ];

    $scope.selectedJob = [];
    $scope.selectedCat = [];

    $scope.selectedJob.value = [];
    $scope.selectedCat.value = [];

    $scope.selectCategory = function(selectedCategory) {
        $scope.jobFilter = [];

        for (let i=0; i<$scope.selectedCat.value.length; i++) {
            for (let j=0; j<$scope.jobFilterAll.length; j++) {
                if ($scope.selectedCat.value[i].id == $scope.jobFilterAll[j].catID) {
                    $scope.jobFilter.push($scope.jobFilterAll[j]);
                }
            }
        }
    }

    $scope.removeCategory = function(selectedCategory) {
        $scope.jobFilter = [];

        for (let i=0; i<$scope.selectedCat.value.length; i++) {
            for (let j=0; j<$scope.jobFilterAll.length; j++) {
                if ($scope.selectedCat.value[i].id == $scope.jobFilterAll[j].catID) {
                    $scope.jobFilter.push($scope.jobFilterAll[j]);
                }
            }
        }

        for (let i=0; i<$scope.selectedJob.value.length; i++) {
            
            if ($scope.selectedJob.value[i].catID == selectedCategory.id) {
                console.log(selectedCategory)
                $scope.selectedJob.value.splice(i, 1);
            }
        } 
    }

    $scope.selectedAll = function(selectedItem) {

        if (selectedItem.id == 0) {
            $scope.locArrayTemp = [];
            $scope.locArrayTemp = $scope.locArray;

            $scope.selectedJob.value = $scope.locArray;
            $scope.selectedJob.value.shift();
            $scope.locArray = [
                {id: -1, name: 'Remove All'} 
            ]
        }

        if (selectedItem.id == -1) {
            $scope.selectedJob.value = {};
            $scope.locArray = $scope.locArrayTemp;
        }
    }

    $scope.submitForm = function(field) {
        console.log($scope.selectedJob.value);
        if ((!$scope.selectedJob.value || $scope.selectedJob.value.length < 1) || (!$scope.selectedCat.value || $scope.selectedCat.value.length < 1)) {
            $ngConfirm({
                theme: 'material',
                title: '<span style="padding: 25px;"><br>&nbsp;&nbsp;&nbsp;Error<br></span>',
                content: '<span style="padding: 20px">All fields are mandatory</span>',
                type: 'red',
                buttons: {
                    close: {
                        text: 'Close',
                        keys: ['enter'],
                        btnClass: 'btn-red'
                    }
                }
            })
        } else {
            $scope.packet.jobs = $scope.selectedJob.value;
            $scope.packet.categories = $scope.selectedCat.value;

            console.log($scope.packet);

            $ngConfirm({
                theme: 'material',
                title: '<span style="padding: 25px;"><br>&nbsp;&nbsp;&nbsp;Success<br></span>',
                content: '<span style="padding: 20px">Subscribed successfully</span>',
                type: 'green',
                buttons: {
                    close: {
                        text: 'Close',
                        keys: ['enter'],
                        btnClass: 'btn-green'
                    }
                }
            });
        }
    }
});