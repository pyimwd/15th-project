<?php

namespace App\Form;

use App\Entity\Item;
use App\Entity\Category;
use App\Entity\UserItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('user')
            ->add(
                'item',
                EntityType::class,
                [
                    'class' => Item::class,
                    // 'multiple' => true,
                    // 'choice_label' => 'title',
                    'expanded' => true,
                    'label' => 'Select the item',
                ]
            )
            // ->add('add_UserItem', SubmitType::class)
        ;
    }



    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserItem::class,
        ]);
    }
}
