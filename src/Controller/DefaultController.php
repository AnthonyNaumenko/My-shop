<?php
namespace App\Controller;
use App\Service\Products;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Product;
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(Products $products)
    {
        return $this->render('default/index.html.twig', [
            'topProducts' => $products->getTopProducts()
        ]);
    }
    /*
    $counter = $session->get('page_counter', 0);
    $counter++;
    $session->set('page_counter', $counter);
    $topProducts = $this->getDoctrine()
        ->getRepository(Product::class)
        -> findBy (['isTop'=>1]);
    return $this->render('default/index.html.twig', [
        'controller_name' => 'DefaultController',
        'counter' => $counter,
        'topProductss'=> $topProducts
    ]);
}*/
    /**
     * @Route("/show/{id}", name="show")
     */
    public function show($id = 'default')
    {
        if ($id=='homepage') {
            return $this->redirectToRoute('homepage');
        }
        if ($id == 'not-found') {
            throw $this->createNotFoundException(' not found ');
        }
        return $this->render('default/show.html.twig', ['id' => $id]);
    }
    /**
     * @Route("/admin")
     */
    public function admin()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }
}
