<?php

namespace App\DataFixtures;

use App\Entity\Marque;
use App\Entity\Categorie;
use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProduitsFixtures extends Fixture
{
    public $faker;
    /**
     * ProduitsFixtures constructor.
     */
    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager)
    {
        $marques=[];
        $categories=[];
        // create 20 products! Bam!
        for ($i = 0; $i < 10; $i++) {
            $marque = new Marque();
            $marque->setNom($this->faker->sentence(2));
            $marque->setSlug($this->faker->sentence(2));
            $marque->setImageName("spons1-617ac966aae0b538832914.png");
            $manager->persist($marque);
            $marques[]=$marque;
        }

        $manager->flush();

        for ($i = 0; $i < 10; $i++) {
            $categorie = new Categorie();
            $categorie->setNom($this->faker->sentence(2));
            $categorie->setTitre($this->faker->sentence(2));
            $categorie->setSlug($this->faker->sentence(2));
            $categorie->setDescription($this->faker->text());
            $categorie->setBaniereImageName("baniere1.png");
            $categorie->setImageName2("agriculture-61850f94a24de725141667.png");
            $manager->persist($categorie);
            $categories[]=$categorie;
        }
        $manager->flush();

        for ($i = 0; $i < 10; $i++) {
            $produit = new Produit();
            $produit->setNom($this->faker->sentence(2));
            $produit->setDescriptiontech($this->faker->sentence(8));
            $produit->setSlug($this->faker->sentence(2));
            $produit->setDescription($this->faker->text());
            $produit->setImageName("john-deere-5060e-60-hp-tractor-1800-kgf.png");
            $produit->setFeatured(false);
            $produit->setCategorie($categories[array_rand($categories)]);
            $produit->setMarque($marques[array_rand($marques)]);
            $manager->persist($produit);
        }
        $manager->flush();

    }
}
