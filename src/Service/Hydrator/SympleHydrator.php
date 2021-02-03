<?php

declare(strict_types=1);

namespace App\Service\Hydrator;

use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class SympleHydrator implements IHydrator
{

    /**
     * @var Serializer
     */
    private Serializer $serializer;

    public function __construct()
    {
        $normalizer = new ObjectNormalizer();
        $this->serializer = new Serializer([new DateTimeNormalizer(), $normalizer]);
    }

    public function hydrate(array $data, string $className): object
    {
        return $this->serializer->denormalize($data, $className);
    }

    public function multiHydrate(array $data, string $className): array
    {
        return array_map(fn($row) => $this->hydrate($row, $className), $data);
    }
}
