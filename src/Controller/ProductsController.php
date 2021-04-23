<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class BasketController extends AbstractController
{
    /**
     * @Route("/basket")
     */
    public function basket(ProductRepository $repo): Response
    {
        $bikes = $repo->findAll();
        // dd($bikes);
        return $this->render('homepage.html.twig', [
            'bikes' => $bikes
        ]);
    }

    /**
     * @Route("/products/{id}",name="products.id")
     */
    public function details($id, Request $request, ProductRepository $repo, SessionInterface $session): Response
    {
        $bike = $repo->find($id);
        if(!$bike){
            throw $this->createNotFoundException('The product does not exist');
            
        }

        // add to basket handling
        $basket = $session->get('basket', []);
        if($request->isMethod('POST')){
            $basket[$bike->getId()] = $bike;
            $session->set('basket', $basket);
        }
        
        $isInBasket = array_key_exists($bike->getId(), $basket);

        return $this->render('details.html.twig', [
            'bike' => $bike,
            'inBasket' => $isInBasket,
        ]);
    }
}
