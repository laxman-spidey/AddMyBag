"use strict";

(function () {

    var testService = function ($http, $location) {
        var factory = {};

        factory.testFunction = function () {
            return $http.post('/index.php/Welcome/testfunction');
        };
        return factory;    
    }
    testService.$inject = ["$http", "$location"];
    AddMyBag.factory("testService", testService);
})();