var AddMyBag = angular.module("AddMyBag", ['ngRoute','AuthModule']);
(function(){
    AddMyBag.run(function($rootScope)
    {
        $rootScope.$on("event:LoginModuleLoaded", function (event){
           AddMyBag.$inject = ['AuthModule'] ;
        });
    });
})();
AddMyBag.config(['$routeProvider', function($routeProvider) {
        $routeProvider.when('/login', { 
        templateUrl: 'index.php/Welcome/LoginPartial', 
            controller: 'AuthController' 
        });
        
        $routeProvider.otherwise({ redirectTo: '/main' });
}]);


   