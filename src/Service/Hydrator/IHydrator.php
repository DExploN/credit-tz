<?php

declare(strict_types=1);

namespace App\Service\Hydrator;

interface IHydrator
{
    public function hydrate(array $data, string $className): object;

    public function multiHydrate(array $data, string $className): array;
}
