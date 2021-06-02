<?php

namespace App\Form;

use App\Model\NirProducts;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NirProductsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('qty', NumberType::class)
            ->add('um', TextType::class)
            ->add('price', MoneyType::class)
            ->add('value', MoneyType::class)
            ->add('type', TextType::class)
            ->add('obs', TextType::class,[
                'required'   => false,
                'attr' => [
                    'replace' => 'replace_me'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NirProducts::class,
        ]);
    }
}
