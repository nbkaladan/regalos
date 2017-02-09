<?php
/**
 * Created by PhpStorm.
 * User: kaladan
 * Date: 21/08/14
 * Time: 13:01
 */

namespace Montano\RegalosBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegaloJugadorType extends AbstractType{

    protected $id_jugador;

    public function __construct($id_jugador){
        $this->id_jugador = $id_jugador;
    }
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('descripcion')
        ;

        $options[] = $this->id_jugador;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'Montano\RegalosBundle\Entity\Regalo',
                'csrf_protection' => false,
                'cascade_validation' => true,
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Regalo';
    }
} 