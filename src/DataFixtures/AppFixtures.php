<?php

namespace App\DataFixtures;

//Import de Faker PHP
use Faker\Factory;
use Faker;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

//Importer les Entity de nos tables
use App\Entity\Seller;
use App\Entity\Product;
use App\Entity\Ticket;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //Créer une instance de faker
        $faker = Faker\Factory::create('fr_FR');

        $users=[];
        $products=[];
        //Ajouter 20 Sellers
        //Boucle pour générer 20 sellers
        for($i=0; $i<20; $i++){
            $user = new Seller();
            $user->setNameSeller($faker->lastname())
                ->setFirstnameSeller($faker->firstname())
                ->setEmailSeller($faker->unique()->email());
            array_push($users,$user);
            $manager->persist($user);
        }

        //Ajouter 50 Produits
        for($i=0; $i<50; $i++){
            $product = new Product();
            $product->setNameProduct($faker->unique()->word())
                ->setDescriptionProduct($faker->paragraph())
                ->setPriceProduct($faker->randomFloat(2,0,500));
            array_push($products,$product);
            $manager->persist($product);
        }

        //Ajout de 10 Ticket
        for($i=0; $i<10; $i++){
            $ticket = new Ticket();
            $ticket->setCreatedAt(new \DateTimeImmutable())
                ->setSeller($users[rand(0,(sizeof($users)-1))])
                ->addProduct($products[rand(0,(sizeof($products)-1))]);
            $manager->persist($ticket);
        }
        $manager->flush();
    }
}
