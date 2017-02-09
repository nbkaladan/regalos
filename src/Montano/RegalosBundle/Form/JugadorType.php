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

class JugadorType extends AbstractType{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('carta_de_reyes', 'collection', array(
                    'type' => 'Regalo',
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false
                ))
            //->addModelTransformer(new RegaloTransformer())
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
                'data_class' => 'Montano\RegalosBundle\Entity\Jugador',
                'csrf_protection' => false,
                'cascade_validation' => true,
                'allow_extra_fields' => true
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'Jugador';
    }
} 