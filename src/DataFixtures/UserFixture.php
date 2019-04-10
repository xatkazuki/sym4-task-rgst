<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;

class UserFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
      $user = new User();
      $user-> setEmail('dummy@example.com');
      $user-> setPassword('$2y$12$mSOv9PV3JNZl.BpzoBS38.KWfG4g3lHyLVYcYzHUpkzElHP1YLxY6');
//      $product->setPrice(14.50);
//      $product->setDescription('Ok, I guess it *does* have a price');
      $manager->persist($user);

        $manager->flush();
    }
}
