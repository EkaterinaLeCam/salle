<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrereservationController extends AbstractController
{
    #[Route('/prereservation', name: 'app_prereservation')]
    public function index(): Response
    {
        return $this->render('prereservation/index.html.twig', [
            'controller_name' => 'PreReservationController',
        ]);
    }
}
