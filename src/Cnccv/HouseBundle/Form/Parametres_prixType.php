<?php

namespace Cnccv\HouseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Parametres_prixType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('jourAnnulable')->add('jourNonAnnulable')->add('penaliteAnnulationTardive')->add('remiseSemaine')->add('remiseMois')->add('minimumFacture')->add('coefPersoSupp')->add('forfaitMenageTtc')->add('joursMenage')->add('taxeSejour')->add('prixDef')->add('tva');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Cnccv\HouseBundle\Entity\Parametres_prix'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'cnccv_housebundle_parametres_prix';
    }


}
