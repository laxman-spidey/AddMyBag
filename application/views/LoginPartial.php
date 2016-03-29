<!-- Form Module-->
<div class="module form-module" ng-app="AuthModule" ng-controller="AuthController as ACntl">
  <div class="toggle"><i class="fa fa-times fa-pencil"></i>
    <div class="tooltip">Register</div>
  </div>
  
  <div class="form">
    <h2>Login to your account</h2>
    <form>
      <input type="text" placeholder="Username" ng-model="username"/>
      <input type="password" placeholder="Password" ng-model="password"/>
      <button ng-click="ACntl.login(username,password)">Login</button>
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
      <button ng-click="ACntl.register(firstName,lastName,email,password,phonenumber)">Register</button>
    </form>
  </div>
  <div class="cta"><a href="http://andytran.me">Forgot your password?</a></div>
    <script type="text/javascript">
      // Toggle Function
        $('.toggle').click(function(){
            // Switches the Icon
            $(this).children('i').toggleClass('fa-pencil');
            // Switches the forms  
            $('.form').animate({
                height: "toggle",
                'padding-top': 'toggle',
                'padding-bottom': 'toggle',
                opacity: "toggle"
            }, "slow");
        });
      </script>
    <link rel="stylesheet" href="Styles/style.css">
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
    
    
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
</div>