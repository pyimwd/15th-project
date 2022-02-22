<?php

namespace App\Form;

use App\Entity\Item;
use App\Entity\Category;
use App\Entity\UserItem;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
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
        // $builder->get('item')
        //     ->addModelTransformer(new CallbackTransformer(
        //         function ($tagsAsArray) {
        //             // dd('allez', $tagsAsArray);
        //             // transform the array to a string
        //             // return implode(', ', $tagsAsArray);
        //         },
        //         function ($itemAsString) {
        //             // dd('retour', $itemAsString);
        //             // transform the string back to an array
        //             foreach ($itemAsString as $item) {
        //                 return $item;
        //             }
        //             // return explode(', ', $itemAsString);
        //         }
        //     ));
    }



    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserItem::class,
        ]);
    }
}
