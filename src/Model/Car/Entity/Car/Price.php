<?php

declare(strict_types=1);

namespace App\Model\Car\Entity\Car;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class Price
{
    /**
     * Цена в копейках
     * @ORM\Column(name="cent", nullable=false, type="integer")
     */
    private int $cent;

    public function __construct(int $cent = 0)
    {
        $this->cent = $cent;
    }
}
