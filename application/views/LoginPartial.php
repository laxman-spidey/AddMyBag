<!-- Form Module-->
<div class="module form-module" ng-app="AuthModule" ng-controller="AuthController as ACntl">
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
    <form>
      <input type="text" placeholder="first name*" ng-model="firstName" value='laxman'/>
      <input type="text" placeholder="last name*" ng-model="lastName" value='spidey'/>
      <input type="email" placeholder="Email Address*" ng-model="email" value='mittu.thefire'/>
      <input type="password" placeholder="Password*" ng-model="password" value='password'/>
      <input type="tel" placeholder="Phone Number*" ng-model="phonenumber" value='1234567'/>
      <button ng-click="ACntl.register(email,password,firstName,lastName,phonenumber)">Register</button>
    </form>
  </div>
  <div class="cta"><a href="http://andytran.me">Forgot your password?</a></div>
    
    <link rel="stylesheet" href="Styles/style.css">
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
    
    
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
</div>