<?php

namespace App\Form;

use App\Entity\Nir;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NirType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('supplier', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Supplier'
                ],
                'label' => false,
            ])
            ->add('receiver', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Receiver'
                ],
                'label' => false
            ])
            ->add('invoiceNumber', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Invoice'
                ],
                'label' => false
            ])
            ->add('date', DateType::class,[
                'attr' => [
                    'class' => 'form-control'
                ],
                'widget' => 'single_text',
                'label' => false
            ])
            ->add('nir_serie', HiddenType::class,[
                'data' => 'N'
            ])
            ->add('reception_committee',TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'reception committee'
                ],
                'label' => false
            ])
            ->add('stock_manager',TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'stock manager'
                ],
                'label' => false
            ])
            ->add('comments',TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'comments'
                ],
                'label' => false,
                'required'   => false,
            ])
            ->add('products', CollectionType::class,[
                'label' => false,
                'entry_type' => NirProductsType::class,
                'entry_options' => [
                    'label' => false,
                ],
                'by_reference' =>false,
                'allow_add' => true,
                'allow_delete' => true
            ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Nir::class,
        ]);
    }
}
