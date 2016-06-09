<md-dialog ng-controller="TransactionController" aria-label="Mango (Fruit)">
    <md-toolbar>
      <div class="md-toolbar-tools">
        <h2>Few more details</h2>
        <span flex></span>
        <md-button class="md-icon-button" ng-click="cancel()">
          <md-icon class="material-icons" ng-click="cancel()" aria-label="Close dialog">clear</md-icon>
        </md-button>
      </div>
    </md-toolbar>
    <md-dialog-content class="inputIcons" >
        <div ng-controller="FormController"  >
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
        
        </div>
    </md-dialog-content>
</m-dialog>
