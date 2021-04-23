<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    /**
     * @Route("/first")
     */
    public function homepage()
    {
        return new Response(
            '<html><body><h1>Welcome!</h1></body></html>'
        );
    }
}
