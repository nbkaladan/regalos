<?php
/**
 * Created by PhpStorm.
 * User: kaladan
 * Date: 11/8/15
 * Time: 20:16
 */

namespace Montano\RegalosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Montano\RegalosBundle\Model\RegaloInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="Regalo")
 */
class Regalo implements RegaloInterface{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $nombre;
    /**
     * @ORM\Column(type="string", length=500)
     */
    protected $descripcion;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Regalo
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Regalo
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function __toString(){
        return "id: ".$this->getId().", nombre: ".$this->getNombre().", descripcion: ".$this->getDescripcion();
    }
}
