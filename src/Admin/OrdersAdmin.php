<?php
/**
 * Created by PhpStorm.
 * User: anthony
 * Date: 17.05.18
 * Time: 23:41
 */

namespace App\Admin;


use App\Entity\Order;
use Doctrine\ORM\QueryBuilder;
use Sirian\SuggestBundle\Form\Type\SuggestType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\CoreBundle\Form\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class OrdersAdmin extends AbstractAdmin
{
    private $statuslables =[

        'В корзине'=> Order::STATUS_DRAFT,
        'Заказан'=>Order::STATUS_ORDERED,
        'Отправлен'=>Order::STATUS_SENT,
        'Закрыт'=>Order::STATUS_DONE,
    ];

    protected function configureFormFields(FormMapper $form)
    {
       $form
           ->add('createdAt')
           ->add('status', ChoiceType::class, [
               'choices'=>$this->statuslables,
           ])
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
         ->addIdentifier('status', 'choice', [
             'choices'=>array_flip($this->statuslables),
         ])
         ->addIdentifier('isPaid')
         ->addIdentifier('amount')
         ->addIdentifier('items', null,[
            /* 'associated_property'=>'product'*/
             'template'=>'admin/order/fields/items.html.twig',
         ])
         ->add('user')
         ->addIdentifier('email')
         ->addIdentifier('phone')
         ->addIdentifier('firstName')
         ->addIdentifier('lastName')
         ;
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('status', 'doctrine_orm_choice',[
                'field_type'=>ChoiceType::class,
                'field_options'=>[
                    'choices'=>$this->statuslables,
                ],
            ])
            ->add('isPaid')
            ->add('amount')
            ->add('createdAt')
            ->add('user')
            ->add('email')
            ->add('phone')
            ->add('firstName')
            ->add('lastName')
        ;
    }

    public function createQuery($context = 'list')
    {
        /**
         * @var QueryBuilder $query
         */
        $query = parent::createQuery($context);

        list($rootAlias) =$query->getRootAliases();
        $query->andWhere($rootAlias.'.amount >0');
        $query->leftJoin($rootAlias.'.items','i')->addSelect('i');
        $query->leftJoin('i.product','p')->addSelect('p');

        return $query;

    }




}