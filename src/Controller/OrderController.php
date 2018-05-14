<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderItem;
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
       $orders->addToCart($product, $quantity, $this->getUser());

       if ($request->isXmlHttpRequest()){
           return $this->render('order/header_cart.html.twig',[
               'cart'=> $orders->getCart()
           ]);
       }

        return $this->redirect($request->headers->get('referer','/'));
    }

    /**
     * @param Orders $ordersCart
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/cart", name="order_cart")
     */
    public function cart(Orders $orders)
    {
        $cart = $orders->getCart();

        return $this->render('order/cart.html.twig', [
            'cart' => $cart]);
    }


    /**
     * @Route("/cart/header", name="order_header_cart")
     */
    public function headerCart(Orders $orders)
    {
        return $this->render('order/header_cart.html.twig',[
            'cart'=> $orders->getCart()
    ]);
    }




    /**
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("order/item/delete/{id}", name="order_delete_item")
     */
    public function deleteItem(OrderItem $item)
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($item);
        $em->flush();

        return $this->redirect('cart');
    }
}
