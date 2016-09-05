<?php
/**
 * Par AETZA.
 * Date: 23/08/2016
 * Heure: 14:42
 */

namespace AE\BackOfficeBundle\Form;


use AE\UserBundle\Form\UserType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;

class UserAddType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options' => array('label' => 'Mot de passe', 'attr' => array('class' => 'form-control')),
                'second_options' => array('label' => 'Confirmer le mot de passe', 'attr' => array('class' => 'form-control'))
            ))
            ->add('isActive', CheckboxType::class, ['label' => 'Activer cet utilisateur', 'required' => false, 'label' => false]);
    }

    public function getParent(){
        return UserType::class;
    }
}