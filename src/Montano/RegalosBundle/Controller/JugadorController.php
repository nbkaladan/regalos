<?php
/**
 * Created by PhpStorm.
 * User: kaladan
 * Date: 20/08/14
 * Time: 13:05
 */

namespace Montano\RegalosBundle\Controller;

use Montano\RegalosBundle\Entity\Jugador;
use Montano\RegalosBundle\Form\RegaloType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcherInterface;

use Symfony\Component\Form\FormTypeInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Montano\RegalosBundle\Form\JugadorType;
use Montano\RegalosBundle\Form\RegaloJugadorType;
use Montano\RegalosBundle\Model\JugadorInterface;
use Montano\RegalosBundle\Exception\InvalidFormException;

class JugadorController extends FOSRestController{

    /**
     * List all Jugadores.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Gets a list of Jugadores",
     *   output = "Montano\RegalosBundle\Entity\Jugador",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the page is not found"
     *   }
     * )
     *
     * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing jugadores.")
     * @Annotations\QueryParam(name="limit", requirements="\d+", default="10", description="How many jugadores to return.")
     *
     * @Annotations\View(templateVar="jugadores")
     *
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     *
     */
    public function getJugadoresAction(Request $request, ParamFetcherInterface $paramFetcher){
        $offset = $paramFetcher->get('offset');
        $offset = null == $offset ? 0 : $offset;
        $limit = $paramFetcher->get('limit');

        return $this->container->get('montano_regalos.jugador.handler')->all($limit, $offset);
    }

    /**
     * Get single Jugador.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Gets a Jugador for a given id",
     *   output = "Montano\RegalosBundle\Entity\Jugador",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the page is not found"
     *   }
     * )
     *
     * @Annotations\View(templateVar="jugador")
     *
     * @param int     $id      the Jugador id
     *
     * @return array
     *
     * @throws NotFoundHttpException when page not exist
     */
    public function getJugadorAction($id){
        return $this->container->get('montano_regalos.jugador.handler')->get($id);
    }


    /**
     * Presents the form to use to create a new Jugador.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View(
     *  templateVar = "form"
     * )
     *
     * @return FormTypeInterface
     */
    public function newJugadorAction()
    {
        return $this->createForm(new JugadorType());
    }

    /**
     * Create a Jugador from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Creates a new Jugador from the submitted data.",
     *   input = "Montano\RegalosBundle\Form\JugadorType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "MontanoRegalosBundle:Jugador:newJugador.html.twig",
     *  statusCode = Codes::HTTP_BAD_REQUEST,
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function postJugadorAction(Request $request)
    {
        try {
            $newJugador = $this->container->get('montano_regalos.jugador.handler')->post(
                $request->request->all()
            );

            $routeOptions = array(
                'id' => $newJugador->getId(),
                '_format' => $request->get('_format')
            );

            return $this->handleView($this->routeRedirectView('get_jugador', $routeOptions, Codes::HTTP_CREATED));

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Update a Jugador from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Creates a new Jugador from the submitted data.",
     *   input = "Montano\RegalosBundle\Form\JugadorType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "MontanoRegalosBundle:Jugador:newJugador.html.twig",
     *  statusCode = Codes::HTTP_BAD_REQUEST,
     *  templateVar = "form"
     * )
     *
     * @param $id Id of the Jugador to update
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function putJugadorAction(Request $request, $id){
        try {
            if (!($jugador_to_update = $this->container->get('montano_regalos.jugador.handler')->get($id))) {
                $statusCode = Codes::HTTP_CREATED;
                $jugador_to_update = $this->container->get('montano_regalos.jugador.handler')->post(
                    $request->request->all()
                );
            } else {
                $statusCode = Codes::HTTP_NO_CONTENT;
                $jugador_to_update = $this->container->get('montano_regalos.jugador.handler')->put(
                    $jugador_to_update,
                    $request->request->all()
                );
            }

            $routeOptions = array(
                'id' => $jugador_to_update->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('get_jugadores', $routeOptions, $statusCode);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Delete a Jugador from the submitted id.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Delete a Jugador from the submitted id.",
     *   input = "id",
     *   statusCodes = {
     *     204 = "Returned when successful",
     *     500 = "Returned when the delete results on errors"
     *   }
     * )
     *
     * @Annotations\View(statusCode=204)
     *
     * @param $id Id of the Jugador to delete
     * @param Request $request the request object
     *
     * @return true
     */
    public function deleteJugadorAction(Jugador $jugador){
        try {
            $this->container->get('montano_regalos.jugador.handler')->delete($jugador);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Put a Regalo for a Jugador from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Creates a new Jugador from the submitted data.",
     *   output = "Montano\RegalosBundle\Form\JugadorType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "MontanoRegalosBundle:Jugador:newRegalo.html.twig",
     *  statusCode = Codes::HTTP_BAD_REQUEST,
     *  templateVar = "form"
     * )
     *
     * @param $id Id of the Jugador to update
     * @param $idRegalo Id of the Regalo to update
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function putJugadorRegaloAction(Request $request, $id, $idRegalo){
        try {
            if (!($jugador_to_update = $this->container->get('montano_regalos.jugador.handler')->get($id))) {
                $statusCode = Codes::HTTP_CREATED;
                $this->container->get('montano_regalos.regalo.handler')->post($request->request->all());
                $jugador_to_update = $this->container->get('montano_regalos.jugador.handler')->post($request->request->all());

            } else {
                $statusCode = Codes::HTTP_NO_CONTENT;
                $form = new RegaloType();
                $regalo = $this->container->get('montano_regalos.regalo.handler')->post(
                    $request->request->get($form->getName())
                );
                $new_carta = $jugador_to_update->getCartaDeReyes();
                $new_carta[] = $regalo;
                $params = array(
                        'carta_de_reyes' => $new_carta
                );
                $jugador_to_update = $this->container->get('montano_regalos.jugador.handler')->patch(
                    $jugador_to_update,
                    $params
                );
            }

            $routeOptions = array(
                'id' => $jugador_to_update->getId(),
                '_format' => $request->get('_format')
            );

            return $this->routeRedirectView('get_jugadores', $routeOptions, $statusCode);

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Create a Regalo for a Jugador from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Creates a new Regalo from the submitted data.",
     *   input = "Montano\RegalosBundle\Form\RegaloType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "MontanoRegalosBundle:Jugador:newJugadorRegalo.html.twig",
     *  statusCode = Codes::HTTP_BAD_REQUEST,
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function postJugadorRegaloAction(Request $request, $id)
    {
        try {
            $form = new RegaloType();
            $newRegalo = $this->container->get('montano_regalos.regalo.handler')->post(
                $request->request->get($form->getName())
            );



            $routeOptions = array(
                'id' => $newRegalo->getId(),
                '_format' => $request->get('_format')
            );

            return $this->handleView($this->routeRedirectView('get_jugador', $routeOptions, Codes::HTTP_CREATED));

        } catch (InvalidFormException $exception) {

            return $exception->getForm();
        }
    }

    /**
     * Presents the form to use to create a new Regalo for a Jugador.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View(
     *  templateVar = "form"
     * )
     *
     * @return FormTypeInterface
     */
    public function newJugadorRegaloAction($id){
        return $this->createForm(new RegaloJugadorType($id), null, array('action' => '/api/jugadors/'.$id.'/regalo'));
    }

    /**
     * Fetch a list of Jugadores or throw an 404 Exception.
     *
     * @return JugadorInterface
     *
     * @throws NotFoundHttpException
     */
    protected function getOr404($id){

        if (!($jugador = $this->container->get('montano_regalos.jugador.handler')->get($id))) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.',$id));
        }

        return $jugador;
    }
} 