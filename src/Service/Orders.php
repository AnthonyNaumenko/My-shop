<?php
/**
 * Created by PhpStorm.
 * User: skillup_student
 * Date: 25.04.18
 * Time: 20:51
 */

namespace App\Service;


use App\Entity\Order;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Orders
{
    const CART_ID = 'cart';

/**
 * @var SessionInterface
 */
    private $session;

    public function __construct(SessionInterface $session, EntityManagerInterface $em)
    {
        $this->session = $session;
        $this->em=$em;
    }
    public function hasCart(){

        return $this->session->has(self::CART_ID);
    }
    public function getCart(): Order
    {
        $order = null;
        $orderID = $this->session->get(self::CART_ID);


        if($orderID!==null){
            $order = $this->em->find(Order::class,$orderID);

        }
        if ($order===null){
            $order= new Order();
            $this->em->persist($order);
            $this->em->flush();
        }
        $this->session->set(self::CART_ID, $order->getId());

        return $order;

    }
    public function addToCart(Product $product, $quantity){
        $order = $this->getCart();
        $existingItem = null;


        foreach ($order->getItems() as $item){
           if ($item->getProduct()-> getID() ==$product->getId() ) {
             $existingItem = $item;
             break;
           }
        }
    }

}