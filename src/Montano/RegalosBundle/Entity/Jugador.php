<?php
/**
 * Created by PhpStorm.
 * User: kaladan
 * Date: 11/8/15
 * Time: 20:16
 */

namespace Montano\RegalosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Montano\RegalosBundle\Model\JugadorInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="Jugador")
 */
class Jugador implements JugadorInterface{
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
     * @ORM\ManyToMany(targetEntity="Regalo")
     * @ORM\JoinTable(name="carta_jugador",
     *      joinColumns={@ORM\JoinColumn(name="id_jugador", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="id_regalo", referencedColumnName="id", unique=true)}
     *      )
     **/
    private $carta_de_reyes;

    public function __construct(){
        $this->carta_de_reyes = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return Jugador
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
     * Add carta_de_reyes
     *
     * @param \Montano\RegalosBundle\Entity\Regalo $regalo
     * @return Jugador
     */
    public function addCartaDeReye(\Montano\RegalosBundle\Entity\Regalo $regalo)
    {
        $this->carta_de_reyes[] = $regalo;

        return $this;
    }

    /**
     * Remove carta_de_reyes
     *
     * @param \Montano\RegalosBundle\Entity\Regalo $regalo
     */
    public function removeCartaDeReye(\Montano\RegalosBundle\Entity\Regalo $regalo)
    {
        $this->carta_de_reyes->removeElement($regalo);
    }

    /**
     * Get carta_de_reyes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCartaDeReyes()
    {
        return $this->carta_de_reyes;
    }
}
