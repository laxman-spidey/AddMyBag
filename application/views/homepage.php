<html>
    <head>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.css">        
        <link rel="stylesheet" href="Scripts/plugins/google.places.autocomplete/autocomplete.css">        
    </head>
    <body ng-app="AddMyBag" ng-controller='testController'>
        <md-toolbar >
            <h1 class="md-primary">AddMyBag</h1>
        </md-toolbar>
        <md-content>
            <input type="text" g-places-autocomplete ng-model="place" />
            <md-button class="md-primary" ng-click='showPlace()' >Click me</md-button>    
        </md-content>
        
        
        
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <script type="text/javascript" src="Scripts/plugins/Angular/angular-route.js"></script>
    <script type="text/javascript" src="Scripts/plugins/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="Scripts/app/app.js"></script>
    <script type="text/javascript" src="Scripts/app/controllers/TestController.js"></script>
    
    <script type="text/javascript" src="Scripts/app/AuthorizationModule.js"></script>
    <script type="text/javascript" src="Scripts/app/google-plus-signin.js"></script>
    <script type="text/javascript" src="Scripts/app/services/testService.js"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-animate.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-aria.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-messages.min.js"></script>

    <!-- Angular Material Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.js"></script>
    <!-- Google Maps library -->    
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places&sensor=false"></script>
    <script type="text/javascript" src="Scripts/plugins/google.places.autocomplete/autocompletedirective.js"></script>
    
</html>

