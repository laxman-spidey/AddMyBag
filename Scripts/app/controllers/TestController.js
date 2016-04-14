"use strict";
(function () {
    var testController = function ($scope, $rootScope,$timeout,testService,$mdDialog) {
        var base_url = window.location.origin;
        $scope.testVar = "testing testing testing";
        $timeout(function() {
            $scope.testVar = "after some timeout";
        }, 100);
        testService.testFunction().success(function (response) {
            $scope.testVar = response.testString;
            console.log(response);
        });
        $scope.cancel = function()
        {
                console.log("coming into close");
                $mdDialog.cancel();
        }
        $scope.showTabDialog = function(ev) {
            $mdDialog.show({
                controller: DialogController,
                templateUrl: 'index.php/Welcome/LoginPartial', 
                parent: angular.element(document.body),
                targetEvent: ev,
                clickOutsideToClose:true
            }).then(function(answer) {
                    $scope.status = 'You said the information was "' + answer + '".';
                }, function() {
                    $scope.status = 'You cancelled the dialog.';
            });
            
        };
        
        $scope.showPlace = function()
        {
            var from = $scope.fromPlace;
            var to = $scope.toPlace;
            console.log(from);
            //console.log($scope.place.address_components[2].long_name);
            var comp;
            for(comp of from.address_components)
            {
                
                if(comp.types[0] === 'country')
                {
                    console.log(comp);
                    
                    console.log(comp.long_name);
                }
                
            }
        }
    };

    function DialogController($scope, $mdDialog) {
        $scope.hide = function() {
            $mdDialog.hide();
        };
        $scope.cancel = function() {
            $mdDialog.cancel();
        };
        $scope.answer = function(answer) {
            $mdDialog.hide(answer);
        };
    }

    testController.$inject = ["$scope","$rootScope","$timeout","testService","$mdDialog"];
    AddMyBag.controller("testController",testController);
    
    
})();
