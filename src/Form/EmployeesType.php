<?php

namespace App\Form;

use App\Entity\Area;
use App\Entity\DocumentType;
use App\Entity\Employees;
use App\Entity\SubArea;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstNames', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('lastNames', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('document', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('documentType', EntityType::class, [
                'class' => DocumentType::class,
                'empty_data' => 'Default value',
                'choice_label' => 'description',
                'placeholder' => ' Select ',
                'attr' => ['class' => 'form-control']
            ])
            ->add('subArea', EntityType::class, [
                'class' => SubArea::class,
                'choice_label' => 'description',
                'placeholder' => ' Select ',
                'attr' => ['class' => 'form-control']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employees::class,
        ]);
    }
}
