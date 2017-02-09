<?php
/**
 * Created by PhpStorm.
 * User: kaladan
 * Date: 11/8/15
 * Time: 20:43
 */

namespace Montano\RegalosBundle\Handler;

use Montano\RegalosBundle\Model\RegaloInterface;

Interface RegaloHandlerInterface {
    /**
     * Get a Regalo given the identifier
     *
     * @api
     *
     * @param mixed $id
     *
     * @return RegaloInterface
     */
    public function get($id);

    /**
     * Get a list of Regalos.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function all($limit = 15, $offset = 0);

    /**
     * Post Regalo, creates a new Regalo.
     *
     * @api
     *
     * @param array $parameters
     *
     * @return RegaloInterface
     */
    public function post(array $parameters);

    /**
     * Edit a Regalo.
     *
     * @api
     *
     * @param RegaloInterface   $regalo
     * @param array           $parameters
     *
     * @return RegaloInterface
     */
    public function put(RegaloInterface $regalo, array $parameters);

    /**
     * Partially update a Regalo.
     *
     * @api
     *
     * @param RegaloInterface   $regalo
     * @param array           $parameters
     *
     * @return RegaloInterface
     */
    public function patch(RegaloInterface $regalo, array $parameters);
} 