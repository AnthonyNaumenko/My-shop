<?php
/**
 * Created by PhpStorm.
 * User: skillup_student
 * Date: 18.04.18
 * Time: 20:39
 */

namespace App\Admin;



use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CategoryAmdin extends AbstractAdmin


{
    protected $datagridValues = [
        '_sort_order'=>'ASC',
        '_sort_by'=>'left'
    ];

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
        ->addIdentifier('id',null, ['sortable'=> false])
        ->addIdentifier('name', null, [
            'sortable'=> false,
            'template'=>'admin/category/fields/name.html.twig'
        ])
        ->add('parent', null, ['sortable'=> false]);
}

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('id')
            ->add('name')
            ->add('parent');
    }

    public function postPersist($object)
    {
        /** @var EntityManagerInterface $em */
        $em = $this->modelManager->getEntityManager($object);
        $repo = $em->getRepository(Category::class);
        $repo->verify();
        $repo->recover();
        $em->flush();
    }

    public function postUpdate($object)
    {
        /** @var EntityManagerInterface $em */
        $em = $this->modelManager->getEntityManager($object);
        $repo = $em->getRepository(Category::class);
        $repo->verify();
        $repo->recover();
        $em->flush();
    }


}