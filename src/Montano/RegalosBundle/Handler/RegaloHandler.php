<?php
/**
 * Created by PhpStorm.
 * User: kaladan
 * Date: 20/08/14
 * Time: 18:09
 */

namespace Montano\RegalosBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;

use Montano\RegalosBundle\Model\RegaloInterface;
use Montano\RegalosBundle\Form\RegaloType;
use Montano\RegalosBundle\Exception\InvalidFormException;

class RegaloHandler implements RegaloHandlerInterface{

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
     * Get a Regalo given the identifier
     *
     * @api
     *
     * @param mixed $id
     *
     * @return RegaloInterface
     */
    public function get($id){
        return $this->repository->find($id);
    }

    /**
     * Get a list of Regalos.
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
     * Post Regalo, creates a new Regalo.
     *
     * @api
     *
     * @param array $parameters
     *
     * @return RegaloInterface
     */
    public function post(array $parameters) {
        $regalo = $this->createRegalo(); // factory method create an empty Regalo

        // Process form does all the magic, validate and hydrate the Regalo Object.
        return $this->processForm($regalo, $parameters, 'POST');
    }

    /**
     * Edit a Regalo.
     *
     * @api
     *
     * @param RegaloInterface $regalo
     * @param array $parameters
     *
     * @return RegaloInterface
     */
    public function put(RegaloInterface $regalo, array $parameters) {
        return $this->processForm($regalo, $parameters, 'PUT');
    }

    /**
     * Partially update a Regalo.
     *
     * @api
     *
     * @param RegaloInterface $regalo
     * @param array $parameters
     *
     * @return RegaloInterface
     */
    public function patch(RegaloInterface $regalo, array $parameters) {
        return $this->processForm($regalo, $parameters, 'PATCH');
    }

    /**
     * Processes the form.
     *
     * @param RegaloInterface $regalo
     * @param array         $parameters
     * @param String        $method
     *
     * @return RegaloInterface
     *
     * @throws \Montano\RegalosBundle\Exception\InvalidFormException
     */
    private function processForm(RegaloInterface $regalo, array $parameters, $method = "PUT"){
        $form = $this->formFactory->create(new RegaloType(), $regalo, array('method' => $method));
        $form->submit($parameters, 'PATCH' !== $method);
        if ($form->isValid()) {

            $regalo = $form->getData();
            $this->om->persist($regalo);
            $this->om->flush($regalo);

            return $regalo;
        }

        throw new InvalidFormException('Invalid submitted data', $form);
    }

    private function createRegalo(){
        return new $this->entityClass();
    }

} 