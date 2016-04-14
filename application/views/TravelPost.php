<md-whiteframe class="md-whiteframe-2dp" flex-sm="45" flex-gt-sm="35" flex-gt-md="25" layout layout-align="center center">
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

</md-whiteframe>