<html>
    <head>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimal-ui" />
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.css">        
        <link rel="stylesheet" href="Scripts/plugins/google.places.autocomplete/autocomplete.css">        
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
    </head>
    <body flex ng-app="AddMyBag" ng-controller='testController' ng-cloak>
        <md-toolbar layout="row" class="md-medium-tall " layout="row" layout-align="space-between center">
            <span layout-padding>
                <h1 layout="column" class="md-primary">AddMyBag</h1>
            </span>
            <span>
                <md-button layout="column" ng-click="showTabDialog($event)"  class="md-primary" ng-click='showPlace()' >Log in</md-button> 
                
                <md-button layout="column" layout-align="center" style="" >
                    <img src="img/gplus.png" style="width:24px;height:24p" ></img>
                </md-button>
                <md-button layout="column" layout-align="center" ><img src="img/fb.png" style="width:24px;height:24p"></img></md-button>
            </span>
        </md-toolbar>
        <md-content>
            
            <div ></div>
            <form class="inputIcons" no-validate name="searchForm">
                
                <md-input-container>
                    <md-icon class="material-icons" >location_on</md-icon>
                    <label>from</label>
                    <input type="text" g-places-autocomplete name="fromPlace" ng-model="fromPlace" required />
                    <div ng-messages="searchForm.fromPlace.$error" ng-show="searchForm.fromPlace.$dirty">
                        <div ng-message="required">This is required!</div>
                    </div>
                </md-input-container>
                <md-input-container>
                    <md-icon class="material-icons" >location_on</md-icon>
                    <label>to</label>
                    <input type="text" g-places-autocomplete name="toPlace" ng-model="toPlace" required />
                    <div ng-messages="searchForm.toPlace.$error" ng-show="searchForm.toPlace.$dirty">
                        <div ng-message="required">This is required!</div>
                    </div>
                </md-input-container>
                
                
                
                <md-button  class="md-primary md-raised" ng-click='showPlace()'  >Search</md-button>    
            </form>
        </md-content>
        
        <div ng-include="'/index.php/Welcome/TravelPostPartial'"></div>
        
    </body>
    
    <style type="text/css">
      .inputIcons {
        /*
      .right-icon {
        position: absolute;
        top: 4px;
        right: 2px;
        left: auto;
        margin-top: 0;
      } */
      }
      .inputIcons .inputIcon {
        min-height: 48px; }
      .inputIcons md-input-container:not(.md-input-invalid) > md-icon {
        color: #03A9F4; }
      .inputIcons md-input-container:not(.md-input-invalid) > md-icon.password {
        color: dodgerblue; }
      .inputIcons md-input-container.md-input-invalid > md-icon,
      .inputIcons md-input-container.md-input-invalid > md-icon.password {
        color: red; }
        
       
        .no-margin {
            margin:0px;
        }
        .no-margin>md-input-container {
            margin:0px;
        }
        .no-padding {
            padding:0px;
        }
        .no-padding>md-input-container {
            padding:0px;
        }
        .no-margin-padding {
            margin:0px;
            padding:0px;
        }
    </style>

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

