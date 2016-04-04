<!DOCTYPE html>
<html ng-app="AddMyBag">
    <head>
        <meta name="google-site-verification" content="wyev4xf3u0pqzr7Qp36lSW3LpwbMOVu6wiNAjgx-r7Y" />
        <title>AddMyBag</title>
    </head>
    <body ng-controller="testController">
        {{testVar}}
        
        <div id="fb-root"> <fb:login-button scope="public_profile,email,user_friends" show-faces="true" max-rows="1" size="large"></fb:login-button></div>
        <br/>
        
        <span id="googleSignIn">
            <span id="signInButton"></span>
        </span>
        <google-plus-signin clientid="998646554798-0f6ppidamm9aqqo9esu73nv0f9lbbhg8.apps.googleusercontent.com">
        
        <div ng-app="AuthModule" ng-controller = "AuthController as authController">
            <a href ng-click="authController.login()">login</a>
            <div ng-include="'/index.php/Welcome/LoginPartial'"></div>
        </div>
        
        
    </body>
    <script type="text/javascript" src="Scripts/plugins/Angular/angular.min.js"></script>
    <script type="text/javascript" src="Scripts/plugins/Angular/angular-route.js"></script>
    <script type="text/javascript" src="Scripts/plugins/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="Scripts/app/app.js"></script>
    <script type="text/javascript" src="Scripts/app/controllers/TestController.js"></script>
    
    <script type="text/javascript" src="Scripts/app/AuthorizationModule.js"></script>
    <script type="text/javascript" src="Scripts/app/google-plus-signin.js"></script>
    <script type="text/javascript" src="Scripts/app/services/testService.js"></script>
        
</html>