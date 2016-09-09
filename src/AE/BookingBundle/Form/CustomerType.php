<?php

namespace AE\BookingBundle\Form;


use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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
            ->add('maternity', EntityType::class, array(
                'class' => 'AE\BookingBundle\Entity\Maternity',
                'choice_label' => 'name',
                'query_builder' => function(EntityRepository $er){
                    return $er->createQueryBuilder('m')
                        ->where('m.isActive = :active')->setParameter('active', true)
                        ->orderBy('m.name', 'ASC');
                },
                'empty_data'  => null,
                'multiple' => false,
                'label' => 'Votre Maternité* :',
                'attr' => array('class' => 'form-control')
            ))
            ->add('orderDate', DateType::class, array('label' => 'Date de publication', 'widget' => 'single_text', 'format' => 'dd/MM/yyyy', 'attr' => array('class' => 'form-control datetimepicker', 'data-date-provide' => 'datepicker', 'data-date-format' => 'DD/MM/YYYY')))
            ->add('name', TextType::class, array( 'label' => 'Nom de la maman* : ', 'attr' => array('class' => "form-control") ))
            ->add('firstName', TextType::class, array( 'label' => 'Prénom de la maman* : ', 'attr' => array('class' => "form-control") ))
            ->add('babyName', TextType::class, array( 'label' => 'Nom du bébé : ', 'required' => false, 'attr' => array('class' => "form-control") ))
            ->add('babyFirstName', TextType::class, array( 'label' => 'Prénom du bébé : ', 'required' => false, 'attr' => array('class' => "form-control") ))
            ->add('dateBirth', DateType::class, array('label' => 'Date de naissance', 'required' => false, 'widget' => 'single_text', 'format' => 'dd/MM/yyyy', 'attr' => array('class' => 'form-control datebirth', 'data-date-provide' => 'datepicker', 'data-date-format' => 'DD/MM/YYYY')))
            ->add('gender', ChoiceType::class, array(
                'choices' => array(
                    'Garçon' => true,
                    'Fille' => false
                ),
                'label' => 'Sexe du bébé :',
                'attr' => array('class' => 'form-control')
            ))
            ->add('weight', NumberType::class, array('scale' => 2, 'label' => 'Poids du bébé (kg) :', 'required' => false, 'attr' => array('class' => "form-control") ))
            ->add('height', TextType::class, array('label' => 'Taille du bébé (cm):', 'required' => false, 'attr' => array('class' => "form-control") ))
            ->add('address', TextType::class, array('label' => 'Adresse* :', 'attr' => array('class' => "form-control")))
            ->add('zip', IntegerType::class, array('label' => 'Code Postal* :', 'attr' => array('class' => "form-control")))
            ->add('city', TextType::class, array('label' => 'Ville* :', 'attr' => array('class' => "form-control")))
            ->add('phone', TextType::class, array('label' => 'Téléphone Fixe :', 'required' => false, 'attr' => array('class' => "form-control")))
            ->add('mobileMother', TextType::class, array('label' => 'Portable de la Maman* :', 'attr' => array('class' => "form-control")))
            ->add('mobileFather', TextType::class, array('label' => 'Portable du Papa :', 'required' => false, 'attr' => array('class' => "form-control")))
            ->add('emailMother', EmailType::class, array('label' => 'Email de la Maman* :', 'attr' => array('class' => "form-control")))
            ->add('emailFather', EmailType::class, array('label' => 'Email du Papa :', 'required' => false, 'attr' => array('class' => "form-control")))
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
