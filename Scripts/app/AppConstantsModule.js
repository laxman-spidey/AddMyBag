"use strict";
var AppConstantsModule = angular.module("AppConstantsModule",[]);
(function () {
    var constants = function()
    {
        var constants = {};
        constants.AUTH_RESPONSE_CODES = {
            // login response codes
            LOGIN_SUCCESS           : 100,
            EMAIL_DOES_NOT_EXISTS   : 101,
            WRONG_PASSWORD          : 102,
            
            //registration response codes
            REGISTER_SUCCESS        : 103,
            EMAIL_ALREADY_TAKEN     : 104
        };
        
        constants.RESPONSE_CODES = {
            
        };
        constants.REQUEST_CODES = {
            
        };
        
        constants.CONTROLLER_CODES = {
            TestController : 501
            
        }
    }
    AppConstantsModule.service("constants",constants);    
    AppConstantsModule.config(function ($provide) {
        $provide.service("constants", constants);
    });    
})();

