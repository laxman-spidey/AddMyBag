"use strict";

var ContentProviderModule = angular.module("ContentProvider",[]);
(function () {
    var ContentProviderService = function () {
        var provider = {};
        provider.data = {};
        provider.addData = function(key, value)
        {
            provider.data[key] = value;    
        }
        provider.getValue = function(key)
        {
            return provider.data[key];
        }
        provider.addLogin = function(controllerCode)
        {
            provider.data['LOGIN_REQUESTOR'] = controllerCode;
        }
        provider.getLoginRequestor = function()
        {
            return provider.data['LOGIN_REQUESTOR'];
        }
    }
    
    
    ContentProviderModule.service("ContentProviderService",ContentProviderService);    
    ContentProviderModule.config(function ($provide) {
        $provide.service("ContentProviderService", ContentProviderService);
    });    
})();

