<?php
/**
 * Par AETZA.
 * Date: 07/09/2016
 * Heure: 09:53
 */

namespace AE\BackOfficeBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class MaternityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('label' => 'Nom de la maternité :', 'attr' => array( 'class' => 'form-control' ) ))
            ->add('isActive', CheckboxType::class, ['label' => 'Activer cet utilisateur', 'required' => false, 'label' => false]);
        ;
    }
}