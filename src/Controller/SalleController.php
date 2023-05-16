<?php

namespace App\Controller;

use App\Repository\SalleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SalleController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/salle/{id}', name: 'app_salle', methods: ['GET', 'POST'])]
    public function show($id): Response
    {
        // Affiche la salle demandée dans le template dédie
        $oneSalle = $this->entityManager->getRepository(Salle::class)->findOneBy(['id' =>$id]);

        return $this->render('salle/salle.html.twig', [
            //recupere la note demandée par son id
            'controller_name' => 'SalleController',
            'oneSalle' => $oneSalle
        ]);
    }
}
