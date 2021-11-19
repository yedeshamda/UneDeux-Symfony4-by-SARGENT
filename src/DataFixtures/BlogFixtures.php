<?php

namespace App\DataFixtures;

use App\Entity\Blog;
use App\Entity\Marque;
use App\Entity\Categorie;
use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class BlogFixtures extends Fixture
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

        // create 20 products! Bam!
        for ($i = 0; $i < 10; $i++) {
            $blog= new Blog();
            $blog->setTitre($this->faker->sentence(2));
            $blog->setDescription($this->faker->sentence(30));
            $blog->setType("blog");
            $blog->setImageName("apropos1-618e94254faf1453068195.jpg");
            $manager->persist($blog);
        }

        $manager->flush();



    }
}
