<?php

namespace App\Form;

use App\Entity\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('cui', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('noroc', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('address', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('bankName', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('bankAccount', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('phoneNumber', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('email', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('webSite', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('director', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
        ]);
    }
}
