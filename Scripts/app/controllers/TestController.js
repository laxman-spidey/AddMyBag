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
        
        $scope.showPlace = function()
        {
            console.log($scope.place);
            //console.log($scope.place.address_components[2].long_name);
            var comp;
            for(comp of $scope.place.address_components)
            {
                
                if(comp.types[0] === 'country')
                {
                    console.log(comp);
                    
                    console.log(comp.long_name);
                }
                
            }
        }
    };


    testController.$inject = ["$scope","$rootScope","$timeout","testService"];
    AddMyBag.controller("testController",testController);
    
    
})();
