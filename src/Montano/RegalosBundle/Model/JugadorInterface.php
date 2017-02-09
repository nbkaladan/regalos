<?php
/**
 * Created by PhpStorm.
 * User: kaladan
 * Date: 11/8/15
 * Time: 20:36
 */

namespace Montano\RegalosBundle\Model;


Interface JugadorInterface {
    public function getId();
    public function setNombre($nombre);
    public function getNombre();
    public function getCartaDeReyes();
} 