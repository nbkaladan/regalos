<?php
/**
 * Created by PhpStorm.
 * User: kaladan
 * Date: 11/8/15
 * Time: 20:43
 */

namespace Montano\RegalosBundle\Handler;

use Montano\RegalosBundle\Model\JugadorInterface;

Interface JugadorHandlerInterface {
    /**
     * Get a Jugador given the identifier
     *
     * @api
     *
     * @param mixed $id
     *
     * @return JugadorInterface
     */
    public function get($id);

    /**
     * Get a list of Jugadores.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function all($limit = 15, $offset = 0);

    /**
     * Post Jugador, creates a new Jugador.
     *
     * @api
     *
     * @param array $parameters
     *
     * @return JugadorInterface
     */
    public function post(array $parameters);

    /**
     * Edit a Jugador.
     *
     * @api
     *
     * @param JugadorInterface   $jugador
     * @param array           $parameters
     *
     * @return JugadorInterface
     */
    public function put(JugadorInterface $jugador, array $parameters);

    /**
     * Partially update a Jugador.
     *
     * @api
     *
     * @param JugadorInterface   $jugador
     * @param array           $parameters
     *
     * @return JugadorInterface
     */
    public function patch(JugadorInterface $jugador, array $parameters);
} 