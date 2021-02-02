<?php

declare(strict_types=1);

namespace App\Model\Car\Repository;

use App\Exception\NotFoundException;
use App\Model\Car\Entity\Brand\Brand;
use App\Model\Car\Entity\Brand\BrandId;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class BrandRepository
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repo;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repo = $entityManager->getRepository(Brand::class);
    }

    public function get(BrandId $brandId): Brand
    {
        $brand = $this->repo->find((string)$brandId);
        if (!$brand) {
            throw new NotFoundException("Автомобиль с id {$brandId} не найден");
        }
        return $brand;
    }

}
