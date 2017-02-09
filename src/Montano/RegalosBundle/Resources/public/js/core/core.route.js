(function() {
    'use strict';

    angular
        .module('Regalos.core')
        .config(RouteConfig);

    RouteConfig.$inject = ['$routeProvider'];

    function RouteConfig ($routeProvider){
        $routeProvider
            .when("/",{
                templateUrl: "partials/jugadores-list.html",
                controller: "Jugadores",
                controllerAs: "vm"
            })
            .otherwise({
                redirectTo: "/"
            })
    }

})();