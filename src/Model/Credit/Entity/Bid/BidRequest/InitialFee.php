<?php

declare(strict_types=1);

namespace App\Model\Credit\Entity\Bid\BidRequest;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class InitialFee
{
    /**
     * @ORM\Column(type="integer")
     */
    private int $initialFee;

    public function __construct(int $initialFee)
    {
        $this->initialFee = $initialFee;
    }
}
