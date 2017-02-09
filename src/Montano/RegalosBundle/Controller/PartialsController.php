<?php
/**
 * Created by PhpStorm.
 * User: kaladan
 * Date: 12/8/15
 * Time: 1:52
 */

namespace Montano\RegalosBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PartialsController extends Controller{
    public function indexAction($partial){
        return $this->render("MontanoRegalosBundle:Partials:".$partial.".twig");
    }
} 