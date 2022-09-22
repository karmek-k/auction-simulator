<?php

namespace App\Controller;

use App\Repository\AuctionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuctionsController extends AbstractController
{
    #[Route('/auctions', name: 'app_auctions')]
    public function index(AuctionRepository $repo): Response
    {
        return $this->render('auctions/index.html.twig', [
            'auctions' => $repo->findActive(),
        ]);
    }
}
