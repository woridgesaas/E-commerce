<?php

namespace App\Infrastructure\Persistence\Doctrine\Fixture;

use App\Infrastructure\Persistence\Doctrine\Entity\ProductDoctrine;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
class ProductsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $products = [
            [
                'id' => 6,
                'name' => 'Lecteur RFID Intelligent',
                'description' => 'Optimisez la sécurité de votre entreprise avec le lecteur RFID intelligent . Ce dispositif permet un contrôle d’accès rapide, sécurisé et sans contact. Idéal pour les bureaux modernes, il garantit une gestion fluide des entrées et sorties. Compatible avec cartes, badges et bracelets RFID, il s’intègre parfaitement avec votre plateforme pour un suivi en temps réel et une automatisation avancée.',
                'status' => 'ACTIVE',
                'type' => 'reader',
                'price' => 1200,
                'image' => '69e4c0535f5f7.jpg',
            ],
            [
                'id' => 7,
                'name' => 'Carte RFID Professionnelle',
                'description' => 'Les cartes RFID offrent une solution fiable et rapide pour l’identification des utilisateurs. Conçues pour un usage professionnel, elles assurent un accès sécurisé en un seul geste. Durables et personnalisables, elles s’adaptent parfaitement aux besoins des entreprises modernes et fonctionnent avec tous les lecteurs .',
                'status' => 'ACTIVE',
                'type' => 'badge',
                'price' => 24.99,
                'image' => '69e4c09f09dce.png',
            ],
            [
                'id' => 8,
                'name' => 'Porte-clé RFID Compact',
                'description' => 'Le porte-clé RFID  est une solution pratique et portable pour accéder rapidement à vos locaux. Léger, résistant et facile à transporter, il offre une expérience utilisateur fluide et moderne. Idéal pour les employés et visiteurs, il permet un accès sécurisé sans effort.',
                'status' => 'ACTIVE',
                'type' => 'badge',
                'price' => 30,
                'image' => '69e4c15310575.jpg',
            ],
            [
                'id' => 9,
                'name' => 'Bracelet RFID Connecté',
                'description' => 'Le bracelet RFID combine confort et technologie pour une utilisation quotidienne. Résistant à l’eau et agréable à porter, il permet un accès sécurisé sans carte ni badge. Parfait pour les entreprises, événements ou salles de sport, il simplifie l’expérience utilisateur.',
                'status' => 'ACTIVE',
                'type' => 'badge',
                'price' => 50,
                'image' => '69e4c185876d4.jpg',
            ],
            [
                'id' => 10,
                'name' => 'Badge RFID Personnalisé',
                'description' => 'Associez identification visuelle et sécurité avec le badge RFID personnalisé Woridge. Il intègre photo, informations utilisateur et technologie RFID pour une gestion complète des accès. Idéal pour les entreprises souhaitant renforcer leur sécurité tout en gardant une image professionnelle.',
                'status' => 'ACTIVE',
                'type' => 'badge',
                'price' => 40,
                'image' => '69e4c1cc49fc6.jpg',
            ],
            [
                'id' => 11,
                'name' => 'Passerelle RFID (Gateway)',
                'description' => 'La passerelle RFID est le cœur de votre système. Elle connecte tous vos équipements RFID à la plateforme SaaS pour une gestion centralisée, sécurisée et en temps réel. Idéale pour les entreprises multi-sites, elle assure performance, fiabilité et contrôle total.',
                'status' => 'ACTIVE',
                'type' => 'gateway',
                'price' => 1800,
                'image' => '69e4e2771082a.jpg',
            ],
        ];

        foreach ($products as $data) {
            $product = new ProductDoctrine();

            $product->setName($data['name']);
            $product->setDescription($data['description']);
            $product->setStatus($data['status']);
            $product->setType($data['type']);
            $product->setPrice($data['price']);
            $product->setImage($data['image']);

            $manager->persist($product);
        }

        $manager->flush();
    }
}
