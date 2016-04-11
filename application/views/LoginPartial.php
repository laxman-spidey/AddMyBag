<md-dialog aria-label="Mango (Fruit)">
  <form>
    <md-toolbar>
      <div class="md-toolbar-tools">
        <h2>Identify Yourself</h2>
        <span flex></span>
        <md-button class="md-icon-button" ng-click="cancel()">
          <md-icon md-svg-src="img/icons/ic_close_24px.svg" aria-label="Close dialog"></md-icon>
        </md-button>
      </div>
    </md-toolbar>
    <md-dialog-content style="width:300px;max-width:400px;max-height:810px; ">
      <md-tabs md-dynamic-height  md-stretch-tabs="always" md-border-bottom>
        <md-tab label="login">
          <md-content layout-padding>
            <form no-validate name="userForm">
                <md-input-container class="md-block">
                    <md-icon md-svg-src="img/icons/ic_email_24px.svg" class="email"></md-icon>
                    <label>Email</label>
                    <input type="text" name="email" ng-model="email" required />
                    <div ng-messages="userForm.email.$error" ng-show="userForm.email.$dirty">
                        <div ng-message="required">Enter your EmailID</div>
                    </div>
                </md-input-container>
                <md-input-container class="md-block" >
                    <label>password</label>
                    <input type="password" name="password" ng-model="password" required />
                    <div ng-messages="userForm.password.$error" ng-show="userForm.password.$dirty">
                        <div ng-message="required">This is required!</div>
                    </div>
                </md-input-container >
                <md-input-container  class="md-block" > 
									  <md-button class="md-raised" >Login</md-button>
							</md-input-container>
            </form>
          </md-content>
        </md-tab>
        <md-tab label="register">
          <md-content class="md-padding">
            
          </md-content>
        </md-tab>
      </md-tabs>
    </md-dialog-content>
    <!--
    <md-dialog-actions layout="row">
      <md-button href="http://en.wikipedia.org/wiki/Mango" target="_blank" md-autofocus>
        More on Wikipedia
      </md-button>
      <span flex></span>
      <md-button ng-click="answer('not useful')" >
        Not Useful
      </md-button>
      <md-button ng-click="answer('useful')" style="margin-right:20px;" >
        Useful
      </md-button>
    </md-dialog-actions>
    -->
  </form>
</md-dialog>




<!-- Form Module
<md-dialog aria-label="label">
<div  ng-app="AuthModule" ng-controller="AuthController as ACntl">

  <div layout="row">
		<div layout="column" flex id="content" role="main">
			<md-content layout="vertical" flex id="content">
				<div layout="row" layout-align="center center" layout-fill>
					<md-whiteframe class="md-whiteframe-z1" layout="column" flex="30" layout-padding>
						<md-content md-theme="docs-dark">
							<md-input-container>
								<label>Email</label>
								<input ng-model="user.email">
							</md-input-container>
							<md-input-container>
								<label>Password</label>
								<input ng-model="user.password" type="password">
							</md-input-container>
							<md-input-container layout-align="center center">
								<div layout="row" layout-sm="column" layout-margin>
									<md-button class="md-raised" flex="50" flex-sm="100">Login</md-button>
									<md-button class="md-raised md-primary" flex="50" flex-sm="100">Register</md-button>
								</div>
							</md-input-container>
						</md-content>
					</md-whiteframe>
					<md-whiteframe>
					  <md-input-container>
              <div id="fb-root"> <fb:login-button scope="public_profile,email,user_friends" show-faces="true" max-rows="1" size="large"></fb:login-button></div>
              <br/>
						</md-input-container>
						<md-input-container>
						  <span id="googleSignIn">
                <span id="signInButton"></span>
              </span>
              <google-plus-signin clientid="998646554798-0f6ppidamm9aqqo9esu73nv0f9lbbhg8.apps.googleusercontent.com">
						</md-input-container>
					</md-whiteframe>
				</div>
			</md-content>
		</div>
	</body>  
  <!--
  <div class="toggle"><i class="fa fa-times fa-pencil"></i>
    <div class="tooltip">Register</div>
  </div>
  
  <div class="form">
    <h2>Login to your account</h2>
    <form>
      <input type="email" placeholder="email" ng-model="email" required/>
      <input type="password" placeholder="Password" ng-model="password" required/>
      <button ng-click="ACntl.login(email,password)">Login</button>
    </form>
    
  </div>
  
  <div class="form">
    <h2>Create an account</h2>
    <form >
      <input type="text" placeholder="first name*" ng-model="firstName" value='laxman'/>
      <input type="text" placeholder="last name*" ng-model="lastName" value='spidey'/>
      <input type="email" placeholder="Email Address*" ng-model="email" value='mittu.thefire'/>
      <input type="password" placeholder="Password*" ng-model="password" value='password'/>
      <input type="tel" placeholder="Phone Number*" ng-model="phonenumber" value='1234567'/>
      <button ng-click="ACntl.register(email,password,firstName,lastName,phonenumber)">Register</button>
    </form>
  </div>
  <div class="cta"><a href="http://andytran.me">Forgot your password?</a></div>
  -->
    <!--
    <link rel="stylesheet" href="Styles/style.css">
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
    
    <!-- Don't forget to place the script that does the asynchronous loading of Google+ JavaScript API.
             Because it is loaded asynchronously, it might take some time to load. 
             Place some loading notification, so user won't get confused. 
             You can use ng-show and ng-hide to show or hide your notification and accomplish best user experience. -->
        <!--
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
</div>
</md-dialog>
-->