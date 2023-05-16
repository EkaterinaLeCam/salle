<?php

namespace App\Controller;

use App\Repository\SalleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SallesController extends AbstractController
{
    #[Route('/salles', name: 'app_salles')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $salle =$entityManager->getRepository(Salle::class)->findAll();

        return $this->render('salles/salles.html.twig', [
            'controller_name' => 'SallesController',
            'salle' =>$salle
            
        ]);
    }
}
