<!DOCTYPE html>
<html ng-app="AddMyBag">
    <head>
        <title>AddMyBag</title>
    </head>
    <body ng-controller="testController">
        {{testVar}}
        
        <div id="fb-root"> <fb:login-button show-faces="true" max-rows="1" size="large"></fb:login-button></div>
        <br/>
        <?php echo base_url("index.php/admin/do_search"); ?>
        
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
    <script type="text/javascript" src="Scripts/app/services/testService.js"></script>
        
</html>