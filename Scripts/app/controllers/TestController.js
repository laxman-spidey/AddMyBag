"use strict";
(function () {
    var testController = function ($scope, $rootScope,$timeout,testService,$mdDialog, $http, FbAuthService, ContentProviderService) {
        var base_url = window.location.origin;
        
        $scope.dateOfArrival = new Date();
        $scope.currentDate = new Date();
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
        
        $scope.showLoginDialog = function(ev) {
            
            $mdDialog.show({
                controller: DialogAuthController,
                templateUrl: 'index.php/Welcome/LoginPartial', 
                parent: angular.element(document.body),
                targetEvent: ev,
                onComplete: onShowDialog,
                clickOutsideToClose:true
            }).then(function(answer) {
                    $scope.status = 'You said the information was "' + answer + '".';
                }, function() {
                    $scope.status = 'You cancelled the dialog.';
            });
            
        };
        
        var onShowDialog = function()
        {
            console.log("loading fb")
            //FbAuthService.initialize();
        }
        
        $scope.TravelsResult = "result will be shown here";
        $scope.searchTravels = function()
        {
            
            var fromPlace = extractAddressComponents($scope.fromPlace);
            var toPlace = extractAddressComponents($scope.toPlace);
            var request = {
                from    : fromPlace,
                to      : toPlace
            };
            $http.post("index.php/SearchController/searchTravels", request)
                .success(function(data, status, headers, config) {
                    console.log("search data");
                    console.log(data);
                    $scope.TravelsResult = data;
                    
                })
                .error(function(data, status, headers, config) {
                    console.log("failure");
                });
        }
        
        var extractAddressComponents = function(responseFromGoogle)
        {
            console.log(responseFromGoogle);
            var location = {};
            location.type               = responseFromGoogle.types[0];
            location.place_id           = responseFromGoogle.place_id;
            location.formatted_address  = responseFromGoogle.formatted_address;
            location.latitude           = responseFromGoogle.geometry.location.lat();
            location.longitude          = responseFromGoogle.geometry.location.lng();
            var comp;
            for(comp of responseFromGoogle.address_components)
            {
                if(    comp.types[0] === 'locality' 
                    || comp.types[0] === 'country' 
                    || comp.types[0] === 'administrative_area_level_2' 
                    || comp.types[0] === 'administrative_area_level_1' 
                    || comp.types[0] === 'postal_code')
                {
                    location[comp.types[0]] = comp.long_name;
                }
            }    
            return location;
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
        $scope.trasactRequest = function(travel,event)
        {
            
            $mdDialog.show({
                locals: travel,
                controller: DialogAuthController,
                templateUrl: 'index.php/Welcome/AddRequestPartial', 
                parent: angular.element(document.body),
                targetEvent: event, 
                onComplete: onShowDialog,
                clickOutsideToClose:true
            }).then(function(answer) {
                    $scope.status = 'You said the information was "' + answer + '".';
                }, function() {
                    $scope.status = 'You cancelled the dialog.';
            });
        }
        
        $scope.$on("onLoginSuccess",function(event, args) {
             var response  = args.response;
             
        });
        
        
    };

    function DialogAuthController($scope, $mdDialog, $controller) {
        
        $controller("AuthController",{$scope, $scope});
        
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
    DialogAuthController.$inject = ["$scope", "$mdDialog", "$controller" ];
    AddMyBag.controller("DialogAuthController",DialogAuthController);

    testController.$inject = ["$scope","$rootScope","$timeout","testService","$mdDialog","$http","FbAuthService","ContentProviderService"];
    AddMyBag.controller("testController",testController);
    
    
})();
