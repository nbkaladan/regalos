<?php

namespace Montano\RegalosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MontanoRegalosBundle:Default:index.html.twig');
    }
}
