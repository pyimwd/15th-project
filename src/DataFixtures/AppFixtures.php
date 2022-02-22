<?php

namespace App\DataFixtures;

use App\Entity\User;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AppFixtures extends Fixture
{
    // Ajout d'un encoder de password
    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i <= 10; $i++) {
            $user = new User();

            // Mot de passe encodé
            $hash = $this->encoder->hashPassword($user, "password");

            $user->setEmail($faker->email())
                ->setFirstname($faker->firstname())
                ->setLastname($faker->lastname())
                ->setModifiedAt(new \DateTimeImmutable())
                ->setPassword($hash)
                ->setCreatedAt(new \DateTimeImmutable())
                ->setRoles([])
                ->setDateOfBirth($faker->dateTimeBetween('-30 years', '-10 years'));
            $manager->persist($user);
        }

        $manager->flush();
    }
}
