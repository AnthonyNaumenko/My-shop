<?php
/**
 * Created by PhpStorm.
 * User: skillup_student
 * Date: 20.04.18
 * Time: 18:50
 */

namespace App\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class UserAdmin extends AbstractAdmin
{
protected function configureFormFields(FormMapper $form)
{
    $form
        ->add('username')
        ->add('password')
        ->add('email')
        ->add('roles')

        ;

}
protected function configureListFields(ListMapper $list)
{
    $list
        ->addIdentifier('id')
        ->addIdentifier('username')
        ->add('password')
        ->addIdentifier('email')
        ->addIdentifier('roles')
        ->add('usernameCanonical')
        ->add('emailCanonical')
        ->add('enabled')
        ->add('salt')
        ->add('lastLogin')
        ;

}
protected function configureDatagridFilters(DatagridMapper $filter)
{
   $filter
       ->add('username')
       ->add('password')
       ->add('email')
       ->add('roles')

   ;
}
}
