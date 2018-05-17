<?php
/**
 * Created by PhpStorm.
 * User: anthony
 * Date: 17.05.18
 * Time: 23:41
 */

namespace App\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class OrdersAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
       $form
           ->add('createdAt')
           ->add('status')
           ->add('isPaid')
           ->add('amount')
           ->add('email')
           ->add('phone')
           ->add('comment')
           ->add('firstName')
           ->add('lastName')
           ;
    }

    protected function configureListFields(ListMapper $list)
    {
     $list
         ->add('createdAt')
         ->add('status')
         ->add('isPaid')
         ->add('amount')
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