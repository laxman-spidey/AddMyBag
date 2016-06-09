var AddMyBag = angular.module("AddMyBag", ['ngRoute'
                                            ,'AuthModule'
                                            ,'AppConstantsModule'
                                            ,'ngMaterial'
                                            ,'ngMessages'
                                            ,'google.places'
                                            ,'ContentProvider'
                                            ]);
(function(){
    AddMyBag.run(function($rootScope,$templateCache, $http)
    {
        $rootScope.$on("event:LoginModuleLoaded", function (event){
           AddMyBag.$inject = ['AuthModule'] ;
        });
        $http.get('index.php/Welcome/LoginPartial', {cache:$templateCache});
        $http.get('index.php/Welcome/addRequestPartial', {cache:$templateCache});
        
    });
    /*
    angular.module('AddMyBag', ['ngMaterial'])
        .config(function($mdThemingProvider) {
          $mdThemingProvider.theme('default')
            .primaryPalette('pink')
            .accentPalette('orange');
    });
    */
    
})();
AddMyBag.config(['$routeProvider',"$mdThemingProvider","$mdIconProvider", function($routeProvider,$mdThemingProvider, $mdIconProvider) {
        $routeProvider.when('/login', { 
        templateUrl: 'index.php/Welcome/LoginPartial', 
            controller: 'AuthController' 
        });
        
        $routeProvider.otherwise({ redirectTo: '/main' });
        
        $mdThemingProvider.theme('default')
            .primaryPalette('blue-grey')
            .accentPalette('purple');
        /*
            palette for theme default's primary palette. Available palettes: 
            red, pink, purple, deep-purple, indigo, blue, light-blue, cyan, teal, 
            green, light-green, lime, yellow, amber, orange, deep-orange, 
            brown, grey, blue-grey
        */
        // configuring material design icon library
        $mdIconProvider
            .iconSet('social', 'img/icons/sets/social-icons.svg', 24)
            .defaultIconSet('img/icons/sets/core-icons.svg', 24);
        
        
}]);


   