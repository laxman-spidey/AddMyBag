"use strict";

(function () {

    var testService = function ($http, $location) {
        var factory = {};

        factory.LoadLactatingMotherCare = function () {
            return $location.url('/CiLactatingMother');
        };
        testService.$inject = ["$http", "$location"];
        AddMyBag.factory("testService", testService);
    }
})();