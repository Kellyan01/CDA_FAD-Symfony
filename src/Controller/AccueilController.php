<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function index(): Response
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }

    #[Route('/accueil/{name}', name: 'app_accueil_name')]
    public function index2($name): Response
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'test_name' => $name,
        ]);
    }

    #[Route('/accueil/{nbr1}/{nbr2}', name: 'app_accueil_addition')]
    public function addition($nbr1, $nbr2): Response
    {
        $message = '';
        if($nbr1 < 0 && $nbr2 < 0){
            $message = 'Les nombres sont négatifs';
        }
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'test_name' => 'Visiteur',
            'message' => $message,
            'nbr1' => $nbr1,
            'nbr2' => $nbr2,
        ]);
    }
}
