<?php

namespace App\Form;

use App\Entity\Invoice;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('billed_products_models', CollectionType::class, [
                'entry_type' => ProductsType::class,
                'entry_options' => [
                    'label' => false,
                ],
                'by_reference' =>false,
                'allow_add' => true,
                'allow_delete' => true
            ])
            ->add('s_noroc')
            ->add('s_bank_account')
            ->add('s_bank_name')
            ->add('s_phone')
            ->add('invoice_number')
            ->add('invoice_serie')
            ->add('invoice_issue_date')
            ->add('s_name')
            ->add('s_cif')
            ->add('s_address')
            ->add('s_email')
            ->add('website')
            ->add('issuer_name')
            ->add('shipp_delegated_name')
            ->add('ci_serie')
            ->add('ci_number')
            ->add('payment_type')
            ->add('delivery_method')
            ->add('invoice_due_date')
            ->add('delivery_date_time')
            ->add('ci_issuer_name')
            ->add('billed_products')
            ->add('total_without_vat')
            ->add('total_with_vat')
            ->add('b_name')
            ->add('b_noroc')
            ->add('b_cif')
            ->add('b_bank_account')
            ->add('b_bank_name')
            ->add('b_address')
            ->add('b_county')
            ->add('save', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Invoice::class,
        ]);
    }
}
