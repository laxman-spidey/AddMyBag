var AddMyBag = angular.module("AddMyBag", ['ngRoute','AuthModule','ngMaterial','ngMessages','google.places']);
(function(){
    AddMyBag.run(function($rootScope)
    {
        $rootScope.$on("event:LoginModuleLoaded", function (event){
           AddMyBag.$inject = ['AuthModule'] ;
        });
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
AddMyBag.config(['$routeProvider',"$mdIconProvider", function($routeProvider, $mdIconProvider) {
        $routeProvider.when('/login', { 
        templateUrl: 'index.php/Welcome/LoginPartial', 
            controller: 'AuthController' 
        });
        
        $routeProvider.otherwise({ redirectTo: '/main' });
        
        // configuring material design icon library
        $mdIconProvider
            .iconSet('social', 'img/icons/sets/social-icons.svg', 24)
            .defaultIconSet('img/icons/sets/core-icons.svg', 24);
        
        
}]);


   