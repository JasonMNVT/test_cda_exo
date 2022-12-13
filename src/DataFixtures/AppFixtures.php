<?php

namespace App\DataFixtures;

use App\Entity\Annonce;
use App\Entity\Marque;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        $marques = [
            'Renault',
            'Peugeot',
            'Citroën'
        ];
        $tabMark = [];
        foreach ($marques as $mark) {
            $marque = new Marque();
            $marque->setName($mark);
            $tabMark[] = $marque;
            $manager->persist($marque);
        }

        $user = new User();
        $user->setUsername('adminFixtures');
        $user->setPassword('123123abc');
        $manager->persist($user);

        $fuelOptions = ['Essence', 'Diesel', 'Hybride'];
        for ($i = 1; $i <= 10; $i++) {
            $article = new Annonce();
            $article->setTitle($this->faker->sentence(4))
                ->setDescription($this->faker->paragraph)
                ->setModel($this->faker->sentence(3))
                ->setPrix($this->faker->randomNumber(5, true))
                ->setYear($this->faker->year())
                ->setKm($this->faker->randomNumber(6, true))
                ->setFuel($this->faker->randomElement($fuelOptions))
                ->setImgfile($this->faker->imageUrl(640, 480, 'cars', true))
                ->setIsVisible($this->faker->numberBetween(0, 1))
                ->setMarque($this->faker->randomElement($tabMark))
                ->setAuthor($user)
                ->setLicense($this->faker->numberBetween(0, 1));
            $manager->persist($article);
        }
        $manager->flush();
    }
}
