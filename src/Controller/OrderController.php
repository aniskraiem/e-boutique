<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Entity\Commentaire;
use App\Entity\User;
use App\Form\AvisType;
use App\Form\CommentaireType;
use App\Repository\AvisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ApiService;

class OrderController extends AbstractController
{
    
    /**
     * @Route("/orders", name="orders", methods={"GET"})
     */

    public function index(ApiService $ApiService): Response
    {
//        dd($ApiService->getOrders());
        $response = $this->render('order.html.twig', [
            'data' => $ApiService->getOrders(),
        ]);

        $response->setSharedMaxAge(3600);

        return $response;
    }



  
}
