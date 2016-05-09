<!DOCTYPE html>
<html ng-app="AddMyBag">
    <head>
                <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimal-ui" />
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.css">        
        <link rel="stylesheet" href="/Scripts/components/angular-google-places-autocomplete/src/autocomplete.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <meta name="google-site-verification" content="wyev4xf3u0pqzr7Qp36lSW3LpwbMOVu6wiNAjgx-r7Y" />
        <title>AddMyBag</title>
    </head>
    <body ng-controller="AuthController">
        {{testVar}}
        
        <div id="fb-root"> <fb:login-button scope="public_profile,email,user_friends" show-faces="true" max-rows="1" size="large"></fb:login-button></div>
        <br/>
        <!--
        <span id="googleSignIn">
            <span id="signInButton"></span>
        </span>
        <google-plus-signin clientid="998646554798-0f6ppidamm9aqqo9esu73nv0f9lbbhg8.apps.googleusercontent.com">
        -->
        <div >
            <div ng-include="'/index.php/Welcome/LoginPartial'"></div>
        </div>
        
        
    </body>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <script src="/Scripts/components/angular-route/angular-route.js"></script>
    <script type="text/javascript" src="/Scripts/components/jquery-1.9.1.min.js"></script>
    
    <!-- Application Script files -->
    <script type="text/javascript" src="Scripts/app/app.js"></script>
    <script type="text/javascript" src="Scripts/app/controllers/TestController.js"></script>
    <script type="text/javascript" src="Scripts/app/controllers/FormController.js"></script>
    <script type="text/javascript" src="Scripts/app/AppConstantsModule.js"></script>
    <script type="text/javascript" src="Scripts/app/AuthorizationModule.js"></script>
    <script type="text/javascript" src="Scripts/app/google-plus-signin.js"></script>
    <script type="text/javascript" src="Scripts/app/services/testService.js"></script>
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-animate.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-aria.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-messages.min.js"></script>

    <!-- Angular Material Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.js"></script>
    <!-- Google Maps library -->    
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places"></script>
    <script type="text/javascript" src="/Scripts/components/angular-google-places-autocomplete/src/autocomplete.js"></script>    
    

</html>