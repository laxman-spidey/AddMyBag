<html>
    <head>
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimal-ui" />
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.css">        
        <link rel="stylesheet" href="/Scripts/components/angular-google-places-autocomplete/src/autocomplete.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
    </head>
    <body flex ng-app="AddMyBag" ng-controller='testController' ng-cloak>
        <md-toolbar layout="row" class="md-medium-tall "   layout-align="space-between center">
            <span layout-padding>
                <h1 class="md-primary">AddMyBag</h1>
            </span>
            <span layout="row" layout-align="center center" ng-controller='AuthController'>
                
                <md-button ng-click="showLoginDialog($event)" ng-click="trasactRequest(null,$event)" aria-label="login" class="md-primary" >Log in</md-button> 
                
                <span id="googleSignIn"  style="width:200px">
                    <span id="signInButton"></span>
                  </span>
                <google-plus-signin autorender="false" buttontype='icon' clientid="998646554798-0f6ppidamm9aqqo9esu73nv0f9lbbhg8.apps.googleusercontent.com" />
                <md-button style="margin-right:10px;" class="fb-login-button md-icon-button" scope="public_profile,email,user_friends" show-faces="true" max-rows="1"  ng-click="fbLogin()" layout-align="center" >
                    <img src="img/fb.png"   aria-label="facebook" style="width:24px;height:24p;"></img>
                </md-button>
            </span>
        </md-toolbar>
        <md-content layout-padding layout="column" layout-align="center center">
            
            
            
            <div class="stats" >
                <h1></h1>
            </div>
            <div  flex-order="100" >
                <div>
                    <span layout-margin class="md-primary">Find a traveller</span> 
                </div>
                <form class="inputIcons" ng-submit="searchTravels()" novalidate name="searchForm" layout="row" layout-xs="column"  layout-align="center center">
                       
                    <md-input-container>
                        <md-icon class="material-icons" >location_on</md-icon>
                        <label>from</label>
                        <input type="text" g-places-autocomplete name="fromPlace" ng-model="fromPlace" required />
                        <div ng-messages="searchForm.fromPlace.$error" >
                            <div ng-message="required">This is required!</div>
                        </div>
                    </md-input-container>
                    <md-input-container>
                        <md-icon class="material-icons" >location_on</md-icon>
                        <label>to</label>
                        <input type="text" g-places-autocomplete name="toPlace" ng-model="toPlace" required />
                        <div ng-messages="searchForm.toPlace.$error" >
                            <div ng-message="required">This is required!</div>
                        </div>
                    </md-input-container>
                    
                    
                    
                    <md-button  class="md-primary md-raised" type="submit"  >Search</md-button>    
                </form>
                <md-whiteframe ng-repeat="item in TravelsResult.data" class="md-whiteframe-4dp"  layout-padding layout-margin layout="column">
                    <div  layout="row" layout-margin  flex>
                            <div layout layout-align="center center">
                                <md-icon  class="material-icons">location_on</md-icon>
                                <div class="md-primary" flex>{{item.from.formattedAddress}}</div>
                            </div>
                            <div layout layout-align="center center" flex="100" >
                                <md-icon   class="material-icons">location_on</md-icon>
                                <div class="md-primary"  flex>{{item.to.formattedAddress}}</div>
                            </div>
                            <div layout layout-align="center center">
                                <md-icon  class="material-icons">attach_money</md-icon>     
                                <div  class="md-primary" flex>{{item.price}}</div>
                            </div>
                            <div layout layout-align="center center">
                                <md-icon   class="material-icons" >business_center</md-icon>
                                <div class="md-primary"  flex>{{item.weight}}</div>
                            </div>
                       </div>
                       <div layout="row" style="height:50px">
                        <div layout layout-align="center center">
                             <md-icon   class="material-icons" >location_on</md-icon>
                             <div  class="md-primary"  flex>{{item.user.firstName}} {{item.user.lastName}} </div>
                        </div>
                        <div layout layout-align="center center">
                             
                             <md-icon  class="material-icons" >location_on</md-icon>
                             <div class="md-primary"  flex>Travelling Date</div>
                        </div>
                       
                        
                    </div>  
                    <div class="container" layout="row"  >
                        
                        <md-button class="md-primary md-raised" ng-click="trasactRequest(item,$event)" flex-end="20">request </md-button>
                    </div>
                </md-whiteframe>
            </div>
        </md-content>
        <!--
        <div >
            <div >
                <div ng-include="'/index.php/Welcome/AddRequestPartial'"></div>    
            </div>
            <div >
                <div ng-include="'/index.php/Welcome/TravelPostPartial'"></div>    
            </div>
        </div>
        -->
    </body>
    
    <style type="text/css">
    
    .tolowercase {
        text-transform: lowercase;
    }

    
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
    <script src="/Scripts/components/angular-route/angular-route.js"></script>
    <script type="text/javascript" src="/Scripts/components/jquery-1.9.1.min.js"></script>
    
    <!-- Application Script files -->
    <script type="text/javascript" src="Scripts/app/app.js"></script>
    <script type="text/javascript" src="Scripts/app/controllers/TestController.js"></script>
    <script type="text/javascript" src="Scripts/app/controllers/FormController.js"></script>
    <script type="text/javascript" src="Scripts/app/AppConstantsModule.js"></script>
    <script type="text/javascript" src="Scripts/app/AuthorizationModule.js"></script>
    <script type="text/javascript" src="Scripts/app/google-plus-signin.js"></script>
    <script type="text/javascript" src="Scripts/app/ContentProvider.js"></script>
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

