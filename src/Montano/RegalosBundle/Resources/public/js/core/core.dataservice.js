(function() {
    'use strict';

    angular
        .module('Regalos.core')
        .factory('dataservice', dataservice);

    /* @ngInject */
    function dataservice($http) {

        var service = {
            getJugadores: getJugadores,
            putJugador: putJugador,
            postJugador: postJugador,
            deleteJugador: deleteJugador,
            putRegalo: putRegalo,
            postRegalo: postRegalo,
            deleteRegalo: deleteRegalo
        };

        return service;

        function getJugadores() {
            return $http.get("api/jugadores");
        }

        function putJugador(jugador){
            return $http.put("api/jugadors/" + jugador.id, jugador);
        }

        function postJugador(jugador){
            return $http.post("api/jugadors", jugador);
        }

        function deleteJugador(jugadorId){
            return $http.delete("api/jugadors/" + jugadorId);
        }

        function putRegalo(jugadorId, regalo){
            return $http.put("api/jugadors/" + jugadorId + "/regalos/" + regalo.id, regalo);
        }

        function postRegalo(jugadorId, regalo){
            return $http.post("api/jugadors/" + jugadorId + "/regalos", regalo);
        }

        function deleteRegalo(jugadorId, regaloId){
            return $http.delete("api/jugadors/" + jugadorId + "/regalos/" + regaloId);
        }

    }
})();

//@ sourceURL=core.dataservice.js