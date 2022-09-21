<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuctionsController extends AbstractController
{
    #[Route('/auctions', name: 'app_auctions')]
    public function index(): Response
    {
        return $this->render('auctions/index.html.twig', [
            'controller_name' => 'AuctionsController',
        ]);
    }
}
