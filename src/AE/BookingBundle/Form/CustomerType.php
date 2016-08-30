<?php

namespace AE\BookingBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('orderDate', DateType::class, array('label' => 'Date de publication', 'widget' => 'single_text', 'format' => 'dd/MM/yyyy', 'attr' => array('class' => 'form-control datetimepicker', 'data-date-provide' => 'datepicker', 'data-date-format' => 'DD/MM/YYYY')))
            ->add('name', TextType::class, array( 'label' => 'Nom de la maman* : '))
            ->add('firstName', TextType::class, array( 'label' => 'Prénom de la maman* : '))
            ->add('babyName', TextType::class, array( 'label' => 'Nom du bébé : '))
            ->add('babyFirstName', TextType::class, array( 'label' => 'Prénom du bébé : '))
            ->add('dateBirth', DateType::class, array('label' => 'Date de naissance', 'widget' => 'single_text', 'format' => 'dd/MM/yyyy', 'attr' => array('class' => 'form-control datebirth', 'data-date-provide' => 'datepicker', 'data-date-format' => 'DD/MM/YYYY')))
            ->add('gender', ChoiceType::class, array(
                'choices' => array(
                    'Garçon' => true,
                    'Fille' => false
                ),
                'label' => 'Sexe du bébé :',
                'attr' => array('class' => 'form-control')
            ))
            ->add('weight', NumberType::class, array('scale' => 2, 'label' => 'Poids du bébé :'))
            ->add('height', TextType::class, array('label' => 'Taille du bébé :'))
            ->add('address', TextType::class, array('label' => 'Adresse* :'))
            ->add('zip', IntegerType::class, array('label' => 'Code Postal* :'))
            ->add('city', TextType::class, array('label' => 'Ville* :'))
            ->add('phone', TextType::class, array('label' => 'Téléphone Fixe :'))
            ->add('mobileMother', TextType::class, array('label' => 'Portable de la Maman* :'))
            ->add('mobileFather', TextType::class, array('label' => 'Portable du Papa :'))
            ->add('emailMother', EmailType::class, array('label' => 'Email de la Maman* :'))
            ->add('emailFather', EmailType::class, array('label' => 'Email du Papa :'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AE\BookingBundle\Entity\Customer'
        ));
    }
}
