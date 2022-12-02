<?php

namespace App\Form;

use App\Entity\Articles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticlesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Amount')
            ->add('Description')
            ->add('Discount')
            ->add('Item')
            ->add('ItemDescription')
            ->add('Quantity')
            ->add('UnitCode')
            ->add('UnitDescriptions')
            ->add('UnitPrice')
            ->add('VATAmount')
            ->add('VATPercentage')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
}
