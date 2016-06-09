"use strict";
var AuthModule = angular.module("AuthModule", [
                                                'ngRoute'
                                                ,'ContentProvider'
                                            ]);
(function () {
    
    //Definition for Authorization Controller
    var AuthController = function($scope, AuthService, $rootScope, $window, FbAuthService, GplusAuthService, UserService, $mdDialog, $mdToast, ContentProviderService){
        console.log("entered controller");
        var RESPONSE_CODE = {
            // login response codes
            LOGIN_SUCCESS : 100,
            EMAIL_DOES_NOT_EXISTS :101,
            WRONG_PASSWORD : 102,
            
            //registration response codes
            REGISTER_SUCCESS : 103,
            EMAIL_ALREADY_TAKEN : 104
        };
        //FbAuthService.loadSDK(document);        
        FbAuthService.initialize();
        
        $scope.fbLogin = function()
        {
            FbAuthService.login(onResponseRecieved);   
        }
        //GplusAuthService.initialize();
        $scope.cancel = function()
        {
            console.log("close function");
            $mdDialog.cancel();
        }
        $scope.register = function(email,password,firstName,lastName,phoneNumber)
        {
            console.log('register');
            UserService.register(email,password,firstName,lastName,phoneNumber, RESPONSE_CODE, onResponseRecieved);
            
        };
        
        $scope.login = function(email,password)
        {
            UserService.appLogin(email, password, RESPONSE_CODE, onResponseRecieved);
        };
        
        $rootScope.$on('$includeContentLoaded', function(event){
            $rootScope.$broadcast("event:LoginModuleLoaded");
            console.log("include content loaded");
            registerSwitchForms();
        });
        $scope.$on("event:google-plus-signin-success", function(event, authResponse) {
            console.log(authResponse);             
            var request = {
                email : authResponse.wc.hg,
                firstName : authResponse.wc.Za,
                lastName : authResponse.wc.Na,
            };
            //UserService.login(response,response.authResponse.accessToken,UserService.LOGIN_VIA_FB);
            
        });
        $scope.$on("event:google-plus-signin-failure", function(event, authResponse) {
            console.log("login failed");
            //UserService.login(response,response.authResponse.accessToken,UserService.LOGIN_VIA_FB);
            
        });       
        
        var onResponseRecieved = function(response, responseCode)
        {
            if(responseCode == RESPONSE_CODE.LOGIN_SUCCESS || responseCode == RESPONSE_CODE.REGISTER_SUCCESS)
            {
                UserService.userId = response.userIdpoouyttr̥eq
                //$scope.$broadcast('onSuccessfulLogin');
                console.log("success :"+ responseCode);
                showSimpleToast("you are logged in");
            }
            else
            {
                //$scope.$broadcast('onFailure',{responseCode: responseCode});
                console.log("failed: " + responseCode);
                showSimpleToast("login failed");
            }
            
        };
        $scope.testToast = function()
        {
            showSimpleToast('text');
        }
        var showSimpleToast = function(text)
        {
            $mdToast.show(
                $mdToast.simple()
                    .textContent(text)
                    .position('fit')
                    .hideDelay(5000)
            );
        }
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
    AuthController.$inject = ["$scope","AuthService","$rootScope",'$window','FbAuthService','GplusAuthService','UserService',"$mdDialog","$mdToast","ContentProviderService"];
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
     
    var FbAuthService = function(UserService, $window, constants, $q)
    {
        var factory = {};
        
        factory.initialize = function()
        {
            factory.loadSDK(document);
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
        factory.loadSDK = function(d) {
            var js,
            id = 'facebook-jssdk',
            ref = d.getElementsByTagName('script')[0];

            if (d.getElementById(id)) {
              return;
            }

            js = d.createElement('script');
            js.id = id;
            js.async = true;
            js.src = "//connect.facebook.net/en_US/sdk.js";

            //insert fb login button
            ref.parentNode.insertBefore(js, ref);
        };
        
        //subscribe tp fb authentication system
        factory.watchLoginChange = function() {
            $window.FB.Event.subscribe('auth.authResponseChange', function(response) {
                console.log(response);
                if (response.status === 'connected') {
                    //UserService.login(response,response.authResponse.accessToken,UserService.LOGIN_VIA_FB);
                    //console.log(factory.getUserInfo());
                    var fbobject = factory.getUserInfo();
                    
                }
                else {
                    UserService.logout();
                }
            });
        };
        factory.login = function(onResponseRecieved)
        {
            console.log("fb login")
            FB.getLoginStatus(function(response) {
                if (response.status === 'connected') {
                    onConnected(response);
                } else {
                    var connection = FB.login(onConnected);
                }
            });
            var onConnected = function(response)    
            {
                console.log("on connected");
                if(response.status === 'connected')
                {
                    console.log("status success");
                    factory.getUserInfo().then(function(fbObject)
                    {
                        console.log("promise returned");
                        UserService.socialLogin(fbObject.email, fbObject.first_name, fbObject.last_name, accessToken, fbObject.id, user.LOGIN_VIA_FB, constants.AUTH_RESPONSE_CODES, onResponseRecieved)
                    });
                }
            }
        }
        factory.getUserInfo = function(){
            var userid;
            var deferred = $q.defer();
            FB.api('/me', 'get', {fields: 'id,email,first_name,last_name,gender' }, function(response) {
                //console.log(response);
                deferred.resolve(response);
            });
            
            /*
            FB.api('/me/permissions', function(response) {
                console.log(response);
            });
            */
            return deferred.promise;
            
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
    
    FbAuthService.$inject = ["UserService","$window","constants","$q"];
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
        factory.initialize = function()
        {
            loadSDK();  
        };
        var loadSDK = function()
        {
            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
            po.src = 'https://apis.google.com/js/client:plusone.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
        };
        var getUserInfo = function()
        {
            
        };
         
        return factory;
    }
    GplusAuthService.$inject = ["UserService","$window"];
    AuthModule.service("GplusAuthService",GplusAuthService);
 
     
     
    
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
        user.loginRequestSent = false;
        user.loginRequestSentVia = -1;
        
        
        user.register = function(email,password,firstName,lastName,phoneNumber, RESPONSE_CODE, onResponseRecieved) {
            var request = {
                email : email,
                password : password,
                firstName : firstName,
                lastName : lastName,
                phoneNumber : phoneNumber,
                responseCode : RESPONSE_CODE,
                LOGIN_VIA_APP : user.LOGIN_VIA_APP
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
            if(user.loginRequestSent == false) {
                user.loginRequestSent = true;
                user.loginRequestSentVia = user.LOGIN_VIA_APP;
                //then send request to the server
                var request = {
                    email : email,
                    password : password,
                    loggedVia : user.LOGIN_VIA_APP,
                    LOGIN_VIA_APP : user.LOGIN_VIA_APP,
                    LOGIN_VIA_FB : user.LOGIN_VIA_FB,
                    LOGIN_VIA_GOOGLE : user.LOGIN_VIA_GOOGLE,
                    responseCode : responseCode,
                };
                ServerInterface.login(request,onResponseRecieved);    
            }
            else
            {
                console.log("User already logged in via "+ user.loginRequestSentVia);                
            }
        };
        user.socialLogin = function(email, firstName, lastName, accessToken, socialId, loggedVia, responseCode, onResponseRecieved)
        {
            var request = {
                email : email,
                firstName : firstName,
                lastName : lastName,
                accessToken : accessToken,
                loggedVia : loggedVia,
                LOGIN_VIA_APP : user.LOGIN_VIA_APP,
                LOGIN_VIA_FB : user.LOGIN_VIA_FB,
                LOGIN_VIA_GOOGLE : user.LOGIN_VIA_GOOGLE,
                responseCode : responseCode,
            };
            ServerInterface.login(request, onResponseRecieved);
            
        };
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
            console.log(request);
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