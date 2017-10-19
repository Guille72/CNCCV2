<?php

namespace Cnccv\HouseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class reservationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('arrivee')->add('depart')->add('nbPersonne')->add('nbNuit')->add('annulation')->add('supplement')->add('avoir')->add('calendrierExt')->add('numReservation');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cnccv\HouseBundle\Entity\reservation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'cnccv_housebundle_reservation';
    }


}
