"use strict";
var AuthModule = angular.module("AuthModule", ['ngRoute']);
(function () {
    
    //Definition for Authorization Controller
    var AuthController = function($scope, AuthService, $rootScope, $window, FbAuthService, UserService ){
        
        var RESPONSE_CODE = {
            // login response codes
            LOGIN_SUCCESS : 100,
            EMAIL_DOES_NOT_EXISTS :101,
            WRONG_PASSWORD : 102,
            
            //registration response codes
            REGISTER_SUCCESS : 103,
            EMAIL_ALREADY_TAKEN : 104
        };
        
        FbAuthService.initialize();
        
        this.register = function(email,password,firstName,lastName,phoneNumber)
        {
            console.log('register');
            UserService.register(email,password,firstName,lastName,phoneNumber, RESPONSE_CODE, onResponseRecieved);
            
        };
        
        this.login = function(email,password)
        {
            UserService.appLogin(email, password, RESPONSE_CODE, onResponseRecieved);
        };
        
        var callback = function()
        {
            console.log("callback");
        };
        
        $scope.$on('$includeContentLoaded', function(event){
            $rootScope.$broadcast("event:LoginModuleLoaded");
            registerSwitchForms();
        });
        
        var onResponseRecieved = function(response, responseCode)
        {
            if(responseCode == RESPONSE_CODE.LOGIN_SUCCESS || responseCode == RESPONSE_CODE.REGISTER_SUCCESS)
            {
                UserService.userId = response.userId;
                //$scope.$broadcast('onSuccessfulLogin');
                console.log("success :"+ responseCode);
            }
            else
            {
                //$scope.$broadcast('onFailure',{responseCode: responseCode});
                console.log("failed: " + responseCode);
            }
        };

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
        };
    };
    AuthController.$inject = ["$scope","AuthService","$rootScope",'$window','FbAuthService','UserService']
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
        
        factory.fbLogin = function(userdata,callback) {
            return $http.post("index.php/Welcome/fbLogin", userdata)
                .success(function(data, status, headers, config) {
                    
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
     
    var FbAuthService = function(UserService, $window)
    {
        var factory = {};
        
        factory.initialize = function()
        {
            loadSDK(document);
            $window.fbAsyncInit = function() {
                FB.init({
                    //appId: '829664043829221', // production app
                    appId: '832379756890983', // test app
                    status: true,
                    cookie: true,
                    version: 'v2.5',
                    channelUrl: 'index.php/welcome/channel',
                    xfbml: true

                });
                factory.watchLoginChange();
            };
            
        };
        
        //Load SDK from Facebook and create a fb signin button
        var loadSDK = function(d) {
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

            //insert fb login button
            ref.parentNode.insertBefore(js, ref);
        };
        
        //subscribe tp fb authentication system
        factory.watchLoginChange = function() {
            $window.FB.Event.subscribe('auth.authResponseChange', function(response) {
                console.log(response);
                if (response.status === 'connected') {
                    UserService.login(response,response.authResponse.accessToken,UserService.LOGIN_VIA_FB);
                    //console.log(factory.getUserInfo());
                    var fbobject = factory.getUserInfo();
                    UserService.login(fbobject)
                }
                else {
                    UserService.logout();
                }
            });
        };

        factory.getUserInfo = function(){
            var userid;
            FB.api('/me', 'get', {fields: 'id,name,gender,email' }, function(response) {
                console.log(response);
                userid = response.id;
                console.log(userid);
                return response;
                /* copied from source
                $rootScope.$apply(function() {
                    $rootScope.user = _self.user = res;
                });
                */
            });
            
            
            FB.api('/me/permissions', function(response) {
                console.log(response);
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
    
    FbAuthService.$inject = ["UserService","$window"];
    AuthModule.service("FbAuthService",FbAuthService);


    /*************************************************************************
     * 
     * Google Plus Authentication Service.
     * Source: http://stackoverflow.com/questions/20809673/how-to-implement-google-sign-in-with-angularjs
     *
     * ***********************************************************************/
     var GplusAuthService = function()
     {
         var factory = {};
         factory.login = function() {
             
         };
         
         factory.logout = function() {
             
         };
         
         return factory;
     }
     
     
     
    
    /*************************************************************************
     * 
     * User Service which acts as model to user data or session. 
     * This service is used accross the app to detect if the user is logged in or not.
     * And also this object used to provide security during routing.
     *
     * ***********************************************************************/
    //Definition of user service function
    var UserService = function(ServerInterface) {
        var user = {
            isLogged: false,
            email: 'dummy',
            password: '',
            accessToken : '',
            socialId: '12345',
            loggedVia: 0,
            userId: 0
        };
        //constants
        user.LOGIN_VIA_APP = 1;
        user.LOGIN_VIA_FB = 2;
        user.LOGIN_VIA_GOOGLE = 3;
        
        
        
        
        user.register = function(email,password,firstName,lastName,phoneNumber, RESPONSE_CODE, onResponseRecieved) {
            var request = {
                email : email,
                password : password,
                firstName : firstName,
                lastName : lastName,
                phoneNumber : phoneNumber,
                responseCode : RESPONSE_CODE
            };
             ServerInterface.register(request, onResponseRecieved);
        };
        
        user.login = function(username,webToken,loggedVia) {
            user.isLogged = true;
            user.username = username;
            user.accessToken = webToken;
            user.loggedVia = loggedVia;
            console.log("user logged in : "+ webToken );
            //user.fbLogin();
        };
        user.appLogin = function(email, password, responseCode, onResponseRecieved)
        {
            var request = {
                email : email,
                password : password,
                loggedVia : user.LOGIN_VIA_APP,
                LOGIN_VIA_APP : user.LOGIN_VIA_APP,
                LOGIN_VIA_FB : user.LOGIN_VIA_FB,
                LOGIN_VIA_GOOGLE : user.LOGIN_VIA_GOOGLE,
                responseCode : responseCode,
                callback : onResponseRecieved
            };
            ServerInterface.login(request,onResponseRecieved);
            
        }
        
        user.logout = function() {
            user.isLogged = false;
            user.username = ''; 
            user.accessToken = '';
            user.loggedVia = 0;
            console.log("user logged out. ");
        };
        
        return user;
    };
    UserService.$inject = ["ServerInterface"];
    /*************************************************************************
     * 
     * This is provider for the entire module.
     * This provider exposes UserService to the outer world (out of AuthModule).
     *
     * ***********************************************************************/
    AuthModule.config(function ($provide) {
        $provide.service("UserService", UserService)
    });

    var ServerInterface = function($http)
    {
        var factory = {};
        factory.register = function(request, callback)
        {
            
            $http.post("index.php/Welcome/register", request).success(function(data, status, headers, config) {
                callback(data, data.responseCode);
            });
        };
        factory.login = function(request, callback)
        {
            $http.post("index.php/Welcome/Login",request)
            .success(function(data, status, headers, config) {
                    callback(data);
            });
        };
        return factory;
        
    }
    ServerInterface.$inject = ["$http"];
    AuthModule.service("ServerInterface", ServerInterface);
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