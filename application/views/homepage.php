<html>
    <head>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.css">        
        <link rel="stylesheet" href="Scripts/plugins/google.places.autocomplete/autocomplete.css">        
    </head>
    <body flex ng-app="AddMyBag" ng-controller='testController' ng-cloak>
        <md-toolbar layout="row">
            <h1 layout="column" class="md-primary">AddMyBag</h1>
            <md-button layout-align="center end" ng-click="showTabDialog($event)"  class="md-primary" ng-click='showPlace()' >Login</md-button> 
            
            <md-button layout-align="center end"  >Google+</md-button>
            <md-button layout-align="end" >Facebook</md-button>
        </md-toolbar>
        <md-content>
            <div ></div>
            <form no-validate name="searchForm">
                <md-input-container>
                    <label>from</label>
                    <input type="text" g-places-autocomplete name="fromPlace" ng-model="fromPlace" required />
                    <div ng-messages="searchForm.fromPlace.$error" ng-show="searchForm.fromPlace.$dirty">
                        <div ng-message="required">This is required!</div>
                    </div>
                </md-input-container>
                <md-input-container>
                    <label>to</label>
                    <input type="text" g-places-autocomplete name="toPlace" ng-model="toPlace" required />
                    <div ng-messages="searchForm.toPlace.$error" ng-show="searchForm.toPlace.$dirty">
                        <div ng-message="required">This is required!</div>
                    </div>
                </md-input-container>
                
                <md-button  class="md-primary md-raised" ng-click='showPlace()' >Search</md-button>    
            </form>
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

