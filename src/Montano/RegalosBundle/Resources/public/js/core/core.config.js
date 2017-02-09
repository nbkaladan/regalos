(function() {
    'use strict';

    angular
        .module('Regalos.core')
        .config(CoreConfig);

    CoreConfig.$inject = ['$interpolateProvider'];

    function CoreConfig ($interpolateProvider){
        $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
    }

})();