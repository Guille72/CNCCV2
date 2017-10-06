<?php
namespace Cnccv\HouseBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $option)
    {
        $builder
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('email', TextType::class)
            ->add('password', TextType::class)
            ->add('city', TextType::class)
            ->add('zip', TextType::class)
            ->add('birthdate', Date::class)
            ->add('tel', TextType::class);
    }
}