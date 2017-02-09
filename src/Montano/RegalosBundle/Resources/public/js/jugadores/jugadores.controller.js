(function () {
    'use strict';

    angular
        .module('Regalos.jugadores')
        .controller('Jugadores', Jugadores);

    Jugadores.$inject = ['dataservice'];

    function Jugadores(dataservice) {
        /*jshint validthis: true */
        var vm = this;

        var defaultPlayer = {
            nombre: "Nombre del jugador"
        };

        vm.entity = [];
        vm.addPresent = addPresent;
        vm.removePresent = removePresent;
        vm.addPlayer = addPlayer;
        vm.removePlayer = removePlayer;
        vm.updatePlayer = updatePlayer;
        vm.updatePresent = updatePresent;

        init();

        function init(){
            dataservice.getJugadores()
                .success(onGetJugadoresSuccess)
                .catch(onGetJugadoresError);
        }

        function onGetJugadoresSuccess(data){
            vm.entity = data;
        }

        function onGetJugadoresError(){
            console.log("Error getting players");
        }

        function addPresent(playerIdx){
            if (!vm.entity[playerIdx].carta_de_reyes){
                vm.entity[playerIdx].carta_de_reyes = [];
            }
            vm.entity[playerIdx].carta_de_reyes.push({});
        }

        function removePresent(playerIdx, presentIdx){
            vm.entity[playerIdx].carta_de_reyes.splice(presentIdx,1);
        }

        function addPlayer(){
            var nuevo = {};
            angular.copy(defaultPlayer, nuevo);
            vm.entity.push(nuevo);
            dataservice.postJugador(nuevo)
                .success(onPostJugadorSuccess)
                .catch(onPostJugadorError);
        }

        function onPostJugadorSuccess(data){
            console.log(data);
        }

        function onPostJugadorError(){
            alert("error");
        }

        function removePlayer(playerIdx){
            var id = vm.entity[playerIdx].id;
            vm.entity.splice(playerIdx,1);
            dataservice.deleteJugador(id)
                .success(onDeleteJugadorSuccess)
                .catch(onDeleteJugadorError);
        }

        function onDeleteJugadorSuccess(){

        }

        function onDeleteJugadorError(){
            alert("Error");
        }

        function updatePlayer(player){
            dataservice.putJugador(player)
                .success(onPutJugadorSuccess)
                .catch(onPutJugadorError);
        }

        function updatePresent(playerId, present){
            dataservice.putRegalo(playerId, present)
                .success(onPutRegaloSuccess)
                .catch(onPutRegaloError);
        }

        function onPutJugadorSuccess(){

        }

        function onPutJugadorError(){

        }

        function onPutRegaloSuccess(){

        }

        function onPutRegaloError(){

        }

    }
})();

//@ sourceURL=jugadores.controller.js