<?php

namespace App\Controller;
use Symfony\Component\Validator\Constraints\DateType;
use App\Form\PrereservationType;
use App\Entity\Salle;
use App\Entity\Utilisateur;
use App\Entity\PreReservation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrereservationController extends AbstractController
{
    #[Route('/reservation/{id}', name: 'app_reservation', methods:['GET','POST'])]
    public function index(Request $request, EntityManagerInterface $toto, EntityManagerInterface $entityManager, int $id): Response
    {
        // Récupération de la salle
    $salle = $toto->getRepository(Salle::class)->find($id);
    
    // Si la salle n'existe pas, on renvoie une erreur 404
    if (!$salle) {
        throw $this->createNotFoundException('La salle demandée n\'existe pas');
    }
    
    $preReservation = new PreReservation();
    $preReservation->setIdSalle($salle);

    // Récupération de l'utilisateur actuel
    $user = $this->getUser();
     // Création du formulaire en passant l'id de la salle et l'id de l'utilisateur
     $form = $this->createForm(PrereservationType::class, $preReservation, [
        // 'utilisateur' => $user->getId(),
        // 'salle' => $id
    ]);

    $form->handleRequest($request);
    
    if ($form->isSubmitted() && $form->isValid()) {
        $preReservation= $form->getData();
        $entityManager->persist($preReservation);
        $entityManager->flush();

        return $this->redirectToRoute('accueil');
    }
    
        return $this->render('prereservation/reservation.html.twig', [
            'controller_name' => 'PreReservationController',
            'pre_reservation' => $preReservation,
            'form' => $form->createView()
        ]);
    }
}
