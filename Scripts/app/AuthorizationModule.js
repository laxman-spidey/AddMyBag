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


    /*************************************************************************
     * 
     * Application Authentication Service.
     * This connects to the AddMyBag Application server.
     *
     * ***********************************************************************/
    var AuthService = function($http, User) {
        var factory = {};

        factory.login = function(userdata, callback) {
            //$location.url('/login');
            return $http.post("index.php/Welcome/Login", userdata)
                .success(function(data, status, headers, config) {
                    console.log(data);
                    if (data.status) {
                        User.login(data.username,'',User.LOGIN_VIA_APP);
                    }
                    else {
                        User.logout();
                    }
                })
                .error(function(data, status, headers, config) {
                    User.logout();
                });
        };

        return factory;
    };
    AuthService.$inject = ["$http","UserService"];
    AuthModule.service("AuthService",AuthService);

    /*************************************************************************
     * 
     * Facebook Authentication Service.
     * Source: http://blog.brunoscopelliti.com/facebook-authentication-in-your-angularjs-web-app/
     *
     * ***********************************************************************/
     
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

                UserService.login(response,'',UserService.LOGIN_VIA_FB);
                /* copied from source
                $rootScope.$apply(function() {
                    $rootScope.user = _self.user = res;
                });
                */
            });
        };
        
        factory.logout = function() {
            FB.logout(function(response) {
                
                UserService.logout();
                /* copied from source
                $rootScope.$apply(function() { 
                    $rootScope.user = _self.user = {}; 
                }); 
                */
            });
        }
        return factory;
    };
    
    FbAuthService.$inject = ["$http","UserService"];
    AuthModule.service("FbAuthService",FbAuthService);


    
    /*************************************************************************
     * 
     * User Service which acts as model to user data or session. 
     * This service is used accross the app to detect if the user is logged in or not.
     * And also this object used to provide security during routing.
     *
     * ***********************************************************************/
    //Definition of user service function
    var UserService = function() {
        var user = {
            isLogged: false,
            username: '',
            loggedVia: 0
        };
        //constants
        user.LOGIN_VIA_APP = 1;
        user.LOGIN_VIA_FB = 2;
        user.LOGIN_VIA_GOOGLE = 3;
        
        
        user.login = function(username,webToken,loggedVia) {
            user.isLogged = true;
            user.username = username;
            user.loggedVia = loggedVia;
        };
        user.logout = function() {
            user.isLogged = false;
            user.username = '';
            user.loggedVia = 0;
        };
        return user;
    };

    /*************************************************************************
     * 
     * This is provider for the entire module.
     * This provider exposes UserService to the outer world (out of AuthModule).
     *
     * ***********************************************************************/
    AuthModule.config(function ($provide) {
        $provide.service("UserService", UserService)
    });

    /*************************************************************************
     * 
     * Configuring the application route to bring  login partial view from the 
     * server whenever required. This is not working in this revision
     *
     * ***********************************************************************/
    AuthModule.config(['$routeProvider', function($routeProvider) {
        $routeProvider.when('/login', {
        templateUrl: 'index.php/Welcome/LoginPartial',
            controller: 'AuthController'
        });


        $routeProvider.otherwise({ redirectTo: '/main' });
    }]);

})();