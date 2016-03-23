"use strict";
var AuthModule = angular.module("AuthModule", ['ngRoute']);
(function () {



    //Definition for Authorization Controller

    var AuthController = function($scope, AuthService, $rootScope, $window ){


        var initializeFacebookAsyncTask = function()
        {
            $window.fbAsyncInit = function() {
                FB.init({
                    appId: '829664043829221',
                    status: true,
                    cookie: true,
                    version: 'v2.5',
                    xfbml: true

                })
            }
        };
        initializeFacebookAsyncTask();
        (function(d){
            // load the Facebook javascript SDK

            var js,
            id = 'facebook-jssdk',
            ref = d.getElementsByTagName('script')[0];

            if (d.getElementById(id)) {
              return;
            }

            js = d.createElement('script');
            js.id = id;
            js.async = true;
            js.src = "//connect.facebook.net/en_US/all.js";

            ref.parentNode.insertBefore(js, ref);

        }(document));
        // configuration object
        var config = {
            username : "dummy",
            password : "dummy"
        };


        this.login = function(username,password)
        {
            var object = {
                  username : username,
                  password : password
            };
            AuthService.login(object, callback);
        }

        /*
        this.register(username,password,email,phone)
        {

        }
        */
        var callback = function()
        {
            console.log("callback");
        }
        $scope.$on('$includeContentLoaded', function(event){
            $rootScope.$broadcast("event:LoginModuleLoaded");
            registerSwitchForms();
        });


        var registerSwitchForms = function()
        {
            $('.toggle').click(function(){
                // Switches the Icon
                $(this).children('i').toggleClass('fa-pencil');
                // Switches the forms
                $('.form').animate({
                    height: "toggle",
                    'padding-top': 'toggle',
                    'padding-bottom': 'toggle',
                    opacity: "toggle"
                }, "slow");
            });
        }
    };
    AuthController.$inject = ["$scope","AuthService","$rootScope",'$window']
    AuthModule.controller("AuthController",AuthController);


    //AuthService definition

    var AuthService = function($http, User) {
        var factory = {};

        factory.login = function(userdata, callback) {
            //$location.url('/login');
            return $http.post("index.php/Welcome/Login", userdata)
                .success(function(data, status, headers, config) {
                    console.log(data);
                    if (data.status) {
                        // succefull login
                        User.isLogged = true;
                        User.username = data.username;
                    }
                    else {
                        User.isLogged = false;
                        User.username = '';
                    }
                })
                .error(function(data, status, headers, config) {
                    User.isLogged = false;
                    User.username = '';
                });
        };

        return factory;
    };
    AuthService.$inject = ["$http","UserService"];
    AuthModule.service("AuthService",AuthService);

    var FbAuthService = function(UserService)
    {
        var factory = {};

        factory.watchLoginChange = function() {
            FB.Event.subscribe('auth.authResponseChange', function(response) {
                if (response.status === 'connected') {

                }
            });
        };

        factory.getUserInfo = function(){
            FB.api('/me', function(response) {

                UserService.username = response;
                /*
                $rootScope.$apply(function() {
                    $rootScope.user = _self.user = res;
                });
                */
            });
        };

        return factory;

    }




    //Definition of user service function
    var UserService = function() {
        var user = {
            isLogged: false,
            username: ''
        };
        return user;
    };

    // Provider for the user session information
    //This shares the service to the other modules
    AuthModule.config(function ($provide) {
        $provide.service("UserService", UserService)
    });

    // Configuration options and routing fr authorization module
    AuthModule.config(['$routeProvider', function($routeProvider) {
        $routeProvider.when('/login', {
        templateUrl: 'index.php/Welcome/LoginPartial',
            controller: 'AuthController'
        });


        $routeProvider.otherwise({ redirectTo: '/main' });
    }]);

})();