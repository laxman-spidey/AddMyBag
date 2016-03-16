"use strict";
(function () {
    var testController = function ($scope, $rootScope,$timeout, $http, $location) {
        var base_url = window.location.origin;
        $scope.testVar = "testing testing testing";
        $timeout(function() {
            $scope.testVar = "after some timeout";
        }, 100);
        $http({url:  base_url+'/Welcome/testFunction', method: "post"}).success(function (response) {        
            $scope.testVar = response.testString;  
        });
        
    };


    testController.$inject = ["$scope","$rootScope","$timeout","$http","$location"];
    AddMyBag.controller("testController",testController);
    
})();
