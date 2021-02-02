<?php

declare(strict_types=1);

namespace App\Model\Car\Repository;

use App\Exception\NotFoundException;
use App\Model\Car\Entity\Car\Car;
use App\Model\Car\Entity\Car\CarId;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class CarRepository
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repo;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repo = $entityManager->getRepository(Car::class);
    }

    public function get(CarId $carId): Car
    {
        $car = $this->repo->find((string)$carId);
        if (!$car) {
            throw new NotFoundException("Автомобиль с id {$carId} не найден");
        }
        return $car;
    }

    public function add(Car $car): void
    {
        $this->entityManager->persist($car);
        $this->entityManager->flush();
    }
}
