<?php
/**
 * Created by PhpStorm.
 * User: anthony
 * Date: 17.05.18
 * Time: 23:41
 */

namespace App\Admin;


use Sirian\SuggestBundle\Form\Type\SuggestType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Form\Type\CollectionType;

class OrdersAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
       $form
           ->add('createdAt')
           ->add('status')
           ->add('isPaid')
           ->add('user', SuggestType::class,[
               'suggester'=>'user',
               'attr'=>[
                   'class' => 'form-control',
                   ],
           ])
           ->add('amount', null,[
               'attr'=>[
                   'readonly'=>'1',
                   'class'=>'js-order-amount',
               ],
           ])
           ->add('email')
           ->add('phone')
           ->add('comment')
           ->add('firstName')
           ->add('lastName')
           ->add('items', CollectionType::class,[

               'by_reference'=>false
           ],[
               'edit'=>'inline',
               'inline'=>'table',
           ])
           ;
    }

    protected function configureListFields(ListMapper $list)
    {
     $list
         ->addIdentifier('id')
         ->addIdentifier('createdAt')
         ->addIdentifier('status')
         ->addIdentifier('isPaid')
         ->addIdentifier('amount')
         ->addIdentifier('email')
         ->addIdentifier('phone')
         ->addIdentifier('comment')
         ->addIdentifier('firstName')
         ->addIdentifier('lastName')
         ;
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('status')
            ->add('isPaid')
            ->add('amount')
            ->add('createdAt')
            ->add('email')
            ->add('phone')
            ->add('comment')
            ->add('firstName')
            ->add('lastName')
        ;
    }


}