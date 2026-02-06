<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Doctrine\ORM\EntityManagerInterface;

//Pour créer un formulaire, on a besoin du FormType voulu et de l'Entity qu'il représente
use App\Entity\Product;
use App\Form\ProductType;

//Import de Request pour récupérer les datas soumis par un Formulaire
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

final class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product',methods:['GET','POST'])]
    public function index(Request $request, EntityManagerInterface $em): Response
    {
        //Je crée l'Entity qui sert de base au formulaire
        $product = new Product();

        //Je crée le formulaire sur la base de l'Entity voulu
        //En paramètre : la Class du FormType voulu, puis l'objet Entity qui sert de base
        $form = $this->createForm(ProductType::class,$product);
        //$form->add('submit', SubmitType::class);

        //Récupération des data retourner par le formulaire au sein de la Request
        $form->handleRequest($request);

        //Vérifier la validité du formulaire
        //Vérifier si le formulaire a été soumis, mais aussi, si les datas correspondent à ce que l'objet, qui a servi de base au formulaire, attend
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($product);

            $em->flush();

            //Renvoyer un message à la route via une variable de type GET
            return $this->redirectToRoute('app_product',['message' => 'enregistrement effectué']);
        }

        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
            'productForm' => $form->createView(),
            'message' => $request->query->get('message'),
        ]);
    }
}
