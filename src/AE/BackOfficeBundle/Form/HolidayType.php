<?php
/**
 * Par AETZA.
 * Date: 23/08/2016
 * Heure: 14:42
 */

namespace AE\BackOfficeBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;

class HolidayType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateStart', DateType::class, array('label' => 'Date de début du congé :', 'widget' => 'single_text', 'format' => 'dd/MM/yyyy', 'attr' => array('class' => 'form-control datetimepicker1', 'data-date-provide' => 'datepicker', 'data-date-format' => 'DD/MM/YYYY')))
            ->add('dateEnd', DateType::class, array('label' => 'Date de fin du congé (ne pas entré la date de reprise):', 'widget' => 'single_text', 'format' => 'dd/MM/yyyy', 'attr' => array('class' => 'form-control datetimepicker2', 'data-date-provide' => 'datepicker', 'data-date-format' => 'DD/MM/YYYY')))
        ;
    }

}