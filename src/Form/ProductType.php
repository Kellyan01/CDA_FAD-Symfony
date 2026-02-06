<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Ticket;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name_product',TextType::class,[
                'label'=>'Nom'
            ])
            ->add('description_product',TextType::class,[
                'required' => true
            ])
            ->add('price_product')
            ->add('tickets', EntityType::class, [
                'class' => Ticket::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('Enregistrer', SubmitType::class)
            //On évite de placer des inputs submit ici dans le but de favoriser la réutilisabilité de ce composant FormType
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
