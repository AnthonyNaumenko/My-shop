<?php
/**
 * Created by PhpStorm.
 * User: skillup_student
 * Date: 18.04.18
 * Time: 21:11
 */

namespace App\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ProductAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('title')
            ->add('price')
            ->add('category')
            ->add('description')
            ->add('isTop');
    }

    protected function configureListFields(ListMapper $list)
    {
       $list
           ->addIdentifier('id')
           ->addIdentifier('title')
           ->addIdentifier('price')
           ->add('isTop')
           ->add('category');
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('title')
            ->add('price')
            ->add('isTop')
            ->add('category');
    }


}