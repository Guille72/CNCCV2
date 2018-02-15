<?php

namespace Cnccv\HouseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichFileType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $option)
    {
        $builder
            ->add('firstname', TextType::class, array(
                'label' => 'form.inscription.firstname.label',
                'required' => true,
                'attr' => array(
                    'class' => 'validate',
                ),
            ))
            ->add('username', TextType::class, array(
                'label' => 'form.inscription.username.label',
                'required' => true,
                'attr' => array(
                    'class' => 'validate',
                ),
            ))
            ->add('email', EmailType::class, array(
                'label' => 'form.inscription.email.label',
                'required' => true,
                'attr' => array(
                    'class' => 'validate',
                ),
            ))
            ->add('plainPassword', RepeatedType::class, array(
                    'type' => PasswordType::class,
                    'invalid_message' => 'The password fields must match.',
                    'options' => array('attr' => array('class' => 'password-field')),
                    'required' => true,
                    'first_options' => array(
                        'label' => 'form.inscription.password.first.label'),
                    'second_options' => array(
                        'label' => 'form.inscription.password.second.label'),
                )
            )
            ->add('address', TextType::class, array(
                'label' => 'form.inscription.address.label',
                'required' => true,
                'attr' => array(
                    'class' => 'validate',
                ),
            ))
            ->add('city', TextType::class, array(
                'label' => 'form.inscription.city.label',
                'required' => true,
                'attr' => array(
                    'class' => 'validate',
                ),
            ))
            ->add('zip', TextType::class, array(
                'label' => 'form.inscription.zip.label',
                'required' => true,
                'attr' => array(
                    'class' => 'validate',
                ),
            ))
            ->add('birthdate', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'html5' => false,
                'label' => 'form.inscription.birthdate.label',
                'required' => true,
                'attr' => array(
                    'class' => 'validate',
                ),
            ))
            ->add('tel', TextType::class, array(
                'label' => 'form.inscription.tel.label',
                'required' => true,
                'attr' => array(
                    'class' => 'validate',
                ),
            ))
            ->add('imageFile', VichFileType::class, array(
                'label' => 'form.inscription.imageFile.label',
                'required' => true,
                'allow_delete' => true,
            ));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }
}