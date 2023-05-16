<?php

namespace App\Controller;

use App\Entity\Ergonomie;
use App\Entity\Logiciel;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Materiel;
use App\Repository\SalleRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SallesController extends AbstractController
{
    #[Route('/salles', name: 'app_salles')]
    public function index(Request $request, ManagerRegistry $dosctrine, SalleRepository $SalleRepository): Response
    {
        // Récuperer tous les objets Salle à partir du SalleRepository

        $salles =$SalleRepository->findAll();

        // Création du formulaire de filtre pour filtrer les objets Salle
        $form = $this->createFormBuilder()
            ->add('capacite')

            ->add('material', EntityType::class, [
                'class' => Materiel::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('software', EntityType::class, [
                'class' => Logiciel::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('ergonomics', EntityType::class, [
                'class' => Ergonomie::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('filter', SubmitType::class, [
                'label' => 'Send',
                'attr' => ['class' => 'btn btn-primary'],
            ])
            ->getForm();

        // Traitement du formulaire de filtre
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Récupération des données du formulaire
            $data = $form->getData();

            // Affichage des données pour débogage
            // dump($data);
            // die();

            // Récupération des objets Room filtrés à partir du SalleRepository
            $salles = $SalleRepository->findByCriteria($data);
        }
        // Renvoi de la réponse (rendu de la vue Twig "salles/salles.html.twig")

        return $this->render('salles/salles.html.twig', [
            'controller_name' => 'SallesController',
            'salles'=>$salles,
            'form' => $form->createView(),
           
            
        ]);
    }
}
