<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ProductsController extends AbstractController
{
   
    /**
     * @Route("/basket",name="products.id")
     */
    public function details(Request $request, SessionInterface $session): Response
    {
        $basket = $session->get('basket', []);

        if($request->isMethod('POST')){
            unset($basket[$request->request->get('id')]);
            $session->set('basket', $basket);
        }

        return $this->render('details.html.twig', [
            'bike' => $bike,
            'inBasket' => $isInBasket,
        ]);
    }
}
