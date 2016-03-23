"use strict";
(function () {
    var testController = function ($scope, $rootScope,$timeout,testService) {
        var base_url = window.location.origin;
        $scope.testVar = "testing testing testing";
        $timeout(function() {
            $scope.testVar = "after some timeout";
        }, 100);
        testService.testFunction().success(function (response) {
            $scope.testVar = response.testString;
            console.log(response);
        });
        
    };


    testController.$inject = ["$scope","$rootScope","$timeout","testService"];
    AddMyBag.controller("testController",testController);
    
    
})();
