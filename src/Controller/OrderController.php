<?php

namespace App\Controller;

use App\Entity\Product;
use App\Service\Orders;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class OrderController extends Controller
{
    /**
     * @Route("/cart/add{id}/{quantity}", name="order_add_to_cart")
     */
    public function addToCart(
        Orders $orders,
        Request $request,
        Product $product,
        $quantity=1
        )
    {
       $orders->addToCart($product, $quantity);

        return $this->redirect($request->headers->get('referer','/'));
    }

    /**
     * @param Orders $ordersCart
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/orders", name="order_cart")
     */
    public function cart(Orders $orders)
    {
        //$orders->getCart();
        $cartId = $orders->getCart()->getId();
        $cartCreated = $orders->getCart()->getCreatedAt();
        $status = $orders->getCart()->getStatus();
        $userId = $orders->getCart()->getUser();
        $isPaid = $orders->getCart()->getIsPaid();
        $amount = $orders->getCart()->getAmount();

        return $this->render('order/cart.html.twig',[
              'cartId'=>$cartId,
              'cartCreated'=>$cartCreated,
              'status'=>$status,
              'user'=>$userId,
              'isPaid'=>$isPaid,
              'amount'=>$amount

    ]);
    }
}
