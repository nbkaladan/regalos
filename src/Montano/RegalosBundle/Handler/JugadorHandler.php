<?php
/**
 * Created by PhpStorm.
 * User: kaladan
 * Date: 20/08/14
 * Time: 18:09
 */

namespace Montano\RegalosBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Montano\RegalosBundle\Entity\Jugador;
use Symfony\Component\Form\FormFactoryInterface;

use Montano\RegalosBundle\Model\JugadorInterface;
use Montano\RegalosBundle\Form\JugadorType;
use Montano\RegalosBundle\Exception\InvalidFormException;

class JugadorHandler implements JugadorHandlerInterface{

    private $om;
    private $entityClass;
    private $repository;
    private $formFactory;

    public function __construct(ObjectManager $om, $entityClass, FormFactoryInterface $formFactory){
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
        $this->formFactory = $formFactory;
    }

    /**
     * Get a Jugador given the identifier
     *
     * @api
     *
     * @param mixed $id
     *
     * @return JugadorInterface
     */
    public function get($id){
        return $this->repository->find($id);
    }

    /**
     * Get a list of Jugadores.
     *
     * @param int $limit the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function all($limit = 15, $offset = 0) {
        return $this->repository->findBy(array(), null, $limit, $offset);
    }

    /**
     * Post Jugador, creates a new Jugador.
     *
     * @api
     *
     * @param array $parameters
     *
     * @return JugadorInterface
     */
    public function post(array $parameters) {
        $jugador = $this->createJugador(); // factory method create an empty Jugador

        // Process form does all the magic, validate and hydrate the Jugador Object.
        return $this->processForm($jugador, $parameters, 'POST');
    }

    /**
     * Edit a Jugador.
     *
     * @api
     *
     * @param JugadorInterface $jugador
     * @param array $parameters
     *
     * @return JugadorInterface
     */
    public function put(JugadorInterface $jugador, array $parameters) {
        return $this->processForm($jugador, $parameters, 'PUT');
    }

    /**
     * Partially update a Jugador.
     *
     * @api
     *
     * @param JugadorInterface $jugador
     * @param array $parameters
     *
     * @return JugadorInterface
     */
    public function patch(JugadorInterface $jugador, array $parameters) {
        return $this->processForm($jugador, $parameters, 'PATCH');
    }

    public function delete(Jugador $jugador){
        $this->om->remove($jugador);
        $this->om->flush();
    }

    /**
     * Processes the form.
     *
     * @param JugadorInterface $jugador
     * @param array         $parameters
     * @param String        $method
     *
     * @return JugadorInterface
     *
     * @throws \Montano\RegalosBundle\Exception\InvalidFormException
     */
    private function processForm(JugadorInterface $jugador, array $parameters, $method = "PUT"){
        $form = $this->formFactory->create(new JugadorType(), $jugador, array('method' => $method));
        $form->submit($parameters, 'PATCH' !== $method);
        if ($form->isValid()) {

            $jugador = $form->getData();
            $this->om->persist($jugador);
            $this->om->flush($jugador);

            return $jugador;
        }

        throw new InvalidFormException('Invalid submitted data', $form);
    }

    private function createJugador(){
        return new $this->entityClass();
    }

} 