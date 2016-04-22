<md-whiteframe ng-controller="FormController"  class="md-whiteframe-5dp" flex-sm="45" flex-gt-sm="35" flex-gt-md="25" layout layout-align="center center">
    <form class="inputIcons" layout-margin no-validate name="travelForm">
        <md-input-container class=" md-icon-float md-block" >
            <md-icon class="material-icons" >location_on</md-icon>
            <label>from</label>
            <input type="text" g-places-autocomplete name="fromPlace" ng-model="fromPlaceAdd" required />
            <div ng-messages="travelForm.fromPlace.$error" ng-show="travelForm.fromPlace.$dirty">
                <div ng-message="required">This is required!</div>
            </div>
        </md-input-container>
        
        <md-input-container class=" md-icon-float md-block" >
            <md-icon class="material-icons" >location_on</md-icon>
            <label>to</label>
            <input type="text" g-places-autocomplete name="toPlaceAdd" ng-model="toPlaceAdd" required />
            <div ng-messages="travelForm.toPlace.$error" ng-show="travelForm.toPlace.$dirty">
                <div ng-message="required">This is required!</div>
            </div>
        </md-input-container>
        
        <md-datepicker class="md-icon-float md-block" ng-model="datePreferredAdd" md-placeholder="Enter date" md-min-date="currentDate"></md-datepicker>
        <div class="validation-messages" ng-messages="travelForm.dateField.$error">
            <div ng-message="valid">The entered value is not a date!</div>
            <div ng-message="required">This date is required!</div>
            <div ng-message="mindate">Date is too early!</div>
        </div>
        
        <md-input-container class=" md-icon-float" >
            <md-icon class="material-icons" >business_center</md-icon>
            <label>Available Weight</label>
            <input type="number" name="weight" ng-model="weightAdd" required />
            <div ng-messages="travelForm.weight.$error" ng-show="travelForm.weight.$dirty">
                <div ng-message="required">This is required!</div>
            </div>
        </md-input-container>
        
        <div  layout-align="end">
            <md-button  class="md-primary md-raised" ng-click='registerTheRequest(fromPlaceAdd,toPlaceAdd,datePreferredAdd,weightAdd)'>Register the Request</md-button>        
        </div>
        
    </form>

</md-whiteframe>