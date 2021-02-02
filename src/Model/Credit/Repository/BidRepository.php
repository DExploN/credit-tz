<?php

declare(strict_types=1);

namespace App\Model\Credit\Repository;

use App\Model\Credit\Entity\Bid\Bid;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class BidRepository
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repo;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repo = $entityManager->getRepository(Bid::class);
    }

    public function add(Bid $bid)
    {
        $this->entityManager->persist($bid);
        $this->entityManager->flush();
    }
}
