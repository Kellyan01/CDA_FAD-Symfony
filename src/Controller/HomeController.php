<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/home/thanks', name: 'app_home_thanks')]
    public function thanks(): Response
    {
        $thanks = "Merci à tous les contributeurs !";
        return $this->render('home/thanks.html.twig', [
            'controller_name' => 'Merci pour votre visite',
            'remerciement' => $thanks,
        ]);
    }

    #[Route('/home/{name}', name: 'app_home')]
    public function paramURL($name): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => $name,
        ]);
    }
}
