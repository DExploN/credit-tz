<?php

declare(strict_types=1);

namespace App\Model\Car\Entity\Car;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class Image
{
    /**
     * @ORM\Column(name="path", nullable=true, type="string")
     */
    private ?string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }
}
