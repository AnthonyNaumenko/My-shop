<?php
/**
 * Created by PhpStorm.
 * User: skillup_student
 * Date: 18.04.18
 * Time: 20:39
 */

namespace App\Admin;



use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CategoryAmdin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->add('name')
            ->add('parent')
            ->add('imageFile', VichImageType::class, ['required' => false])
            ;
    }
    protected function configureListFields(ListMapper $list)
{
    $list
        ->addIdentifier('id')
        ->addIdentifier('name')
        ->add('parent');
}

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('id')
            ->add('name')
            ->add('parent');
    }

}