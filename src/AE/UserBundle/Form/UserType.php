<?php
/**
 * Par AETZA.
 * Date: 23/08/2016
 * Heure: 10:47
 */

namespace AE\UserBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array('label' => 'Email', 'attr' => array('class' => 'form-control')))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options' => array('label' => 'Mot de passe', 'attr' => array('class' => 'form-control')),
                'second_options' => array('label' => 'Confirmer le mot de passe', 'attr' => array('class' => 'form-control'))
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AE\UserBundle\Entity\User'
        ));
    }

}