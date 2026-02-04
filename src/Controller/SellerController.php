<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

//Import du Repository pour permettre d'accéder aux data dans la BDD
use App\Repository\SellerRepository;

final class SellerController extends AbstractController
{
    #[Route('/seller', name: 'app_seller')]
    public function index(SellerRepository $sellerRepository): Response
    {
        //Récupérer TOUS les seller : findAll()
        //Récupérer un Seller via son id : find(id)
        //Récupérer des Seller selon un critère (condition Where) : findBy(array $critere, array $orderBy = null, $limit = null)
        // -> $critere est un tableau associatif : ['name_seller' => 'Yoann']
        //Récupérer un seul Seller selon un critère : findOneBy(array $critere, array $orderBy = null)

        //Récupérons tous les Seller
        $sellers = $sellerRepository->findAll();

        //var_dump($sellers[3]);

        return $this->render('seller/index.html.twig', [
            'controller_name' => 'SellerController',
            'sellers' => $sellers,
        ]);
    }

    #[Route('/seller/{id}', name: 'app_seller_id')]
    public function profil(SellerRepository $sellerRepository, $id): Response
    {
        //Récupérons le Seller avec son id
        $seller = $sellerRepository->find($id);

        return $this->render('seller/index.html.twig', [
            'controller_name' => 'SellerController',
            'seller' => $seller,
        ]);
    }

    #[Route('/seller/email/{email}', name: 'app_seller_email')]
    public function email(SellerRepository $sellerRepository, $email): Response
    {
        //Récupérons le Seller avec son email
        $seller = $sellerRepository->findOneBy(['email_seller' => $email]);

        return $this->render('seller/index.html.twig', [
            'controller_name' => 'SellerController',
            'sellerEmail' => $seller,
        ]);
    }
}
