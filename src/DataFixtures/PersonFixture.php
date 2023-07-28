<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Person;

class PersonFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 150; $i++) {
            $person = new Person();
            $person->setName($faker->name);
            $person->setAge($faker->numberBetween(18, 100));
            $person->setPhone($faker->phoneNumber);
            $person->setAddress($faker->address);
            $manager->persist($person);
        }
        $manager->flush();
    }
}
