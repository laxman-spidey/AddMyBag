"use strict";
(function () {
    var TravelFormController = function ($scope, $rootScope,constants,$timeout,$mdDialog, TravelFormService) {
        
        
        $scope.weight = 5;
        $scope.pricePerKg = 2;
        
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
        
        function getDateInSQLformat(date)
        {
            var dateString = date.toISOString();
            dateString = dateString.replace("T"," ");
            dateString = dateString.substring(0, dateString.length - 5);
            return dateString;
        }
        $scope.registerTheTravel = function()
        {
            console.log("register travel");
            var fromPlace = extractAddressComponents($scope.fromPlace);
            var toPlace = extractAddressComponents($scope.toPlace);
            var dateString = getDateInSQLformat($scope.dateOfArrival);
            
            var request = {
                from        : fromPlace,
                to          : toPlace,
                arrivalDate : dateString,
                weight      : $scope.weight,
                pricePerKg  : $scope.pricePerKg,
                userId      : 1
            };
            console.log(request);
            TravelFormService.insertTravelPost(request);
        };
        
        
        
        var base_url = window.location.origin;
        
        /*
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
        */
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

    TravelFormController.$inject = ["$scope","$rootScope","constants","$timeout","$mdDialog","TravelFormService"];
    AddMyBag.controller("TravelFormController",TravelFormController);
    
    
    var TravelFormService = function($http)
    {
        var factory = {};
        factory.insertTravelPost = function(request) {
            $http.post("index.php/Welcome/registerTheTravel", request)
                .success(function(data, status, headers, config) {
                    console.log(data);
                })
                .error(function(data, status, headers, config) {
                    console.log("failure");
                });
        }
        return factory;
    }
    
    TravelFormService.$inject = ["$http"]
    AddMyBag.service("TravelFormService",TravelFormService);
})();
