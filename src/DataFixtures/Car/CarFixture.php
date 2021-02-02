<?php

namespace App\DataFixtures\Car;

use App\Model\Car\Entity\Brand\Brand;
use App\Model\Car\Entity\Car\Car;
use App\Model\Car\Entity\Car\CarId;
use App\Model\Car\Entity\Car\Image;
use App\Model\Car\Entity\Car\Price;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class CarFixture extends Fixture implements DependentFixtureInterface
{
    public const ID = '7c5cf423-5807-4f11-87fd-268035b0f7b7';

    public function load(ObjectManager $manager)
    {
        /** @var Brand $brand */
        $brand = $this->getReference(BrandFixture::ID);
        for ($i = 0; $i < 20; $i++) {
            $uid = Uuid::uuid6()->toString();
            if ($i === 0) {
                $uid = self::ID;
            }
            $car = new Car(new CarId($uid), 'CX' . $i, $brand);
            $car->changeImage(new Image("cars/{$uid}/image.jpg"));
            $car->changePrice(new Price(100));
            $manager->persist($car);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            BrandFixture::class
        ];
    }
}
