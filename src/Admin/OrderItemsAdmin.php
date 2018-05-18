<?php
/**
 * Created by PhpStorm.
 * User: skillup_student
 * Date: 18.05.18
 * Time: 19:17
 */

namespace App\Admin;


use Sirian\SuggestBundle\Form\Type\SuggestType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;

class OrderItemsAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('product', SuggestType::class,[
                'suggester'=>'product',
            ])
            ->add('quantity', null,[
                'attr'=>[
                    'class'=>'js-order-item-quantity'
                ]
            ])
            ->add('price', null,[
                'attr'=>[
                    'class'=> 'js-order-item-price'
                ]
            ])
            ->add('amount', null,[
                'attr'=>[
                    'readonly'=>'1',
                    'class'=> 'js-order-item-amount',
                ]
            ])
        ;
    }

}