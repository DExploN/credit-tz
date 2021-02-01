<?php

namespace App\DataFixtures\Car;

use App\Model\Car\Entity\Brand\Brand;
use App\Model\Car\Entity\Brand\BrandId;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandFixture extends Fixture
{
    public const ID = '7497b080-ad46-41c6-afcc-91ba41f9c992';

    public function load(ObjectManager $manager)
    {
        $brand = new Brand(new BrandId(self::ID), 'BMW');
        $this->addReference(self::ID, $brand);
        $manager->persist($brand);
        $manager->flush();
    }
}
