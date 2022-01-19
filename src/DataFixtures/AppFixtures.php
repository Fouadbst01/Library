<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Provider\DateTime;
use App\Entity\Auteur;
use App\Entity\Genre;
use App\Entity\Livre;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("fr_FR");
        
        $auteurs=[];
        for($i=0;$i<20; $i++){
            $gender = $faker->randomElement(['male', 'female']);
            $auteur = new Auteur();
            $auteur->setNomPrenom($faker->name($gender));
            $auteur->setNationalite($faker->country());
            $auteur->setSexe(strtoupper($gender[0]));   
            $auteur->setDateDeNaissance(\DateTimeImmutable::createFromMutable(
                DateTime::dateTimeBetween('-100 years')
            ));
            $auteurs[]=$auteur;
            $manager->persist($auteur);
        }
        
        $genres = [];
        for($i=0;$i<10;$i++){
            $genre = new Genre();
            $genre->setNom($faker->word());
            $genres[]=$genre;
            $manager->persist($genre);
        }
        

        for($i=0;$i<50;$i++){
            $livre = new Livre();            
            $livre->setIsbn($faker->isbn13());
            $livre->setNombrePages($faker->randomNumber());
            $livre->setNote($faker->numberBetween(0,20));
            $livre->setTitre($faker->sentence($faker->numberBetween(1,3)));
            $livre->setDateDeParution(\DateTimeImmutable::createFromMutable(
                DateTime::dateTimeBetween('-122 years','now')
            ));
            for($j=0;$j<random_int(0,3);$j++){
                $livre->addGenre($faker->randomElement($genres));
            }
            for($j=0;$j<random_int(0,3);$j++){
                $livre->addAuteur($faker->randomElement($auteurs));
            }
            //$livre->setIdGenre($faker->randomElement($genre));
            $manager->persist($livre);
        }

        
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
