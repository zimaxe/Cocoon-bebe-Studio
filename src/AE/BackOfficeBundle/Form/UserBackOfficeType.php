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
use Symfony\Component\Form\FormBuilderInterface;

class UserBackOfficeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isActive', CheckboxType::class, ['label' => 'Activer cet utilisateur', 'required' => false, 'label' => false]);
    }

    public function getParent(){
        return UserType::class;
    }
}