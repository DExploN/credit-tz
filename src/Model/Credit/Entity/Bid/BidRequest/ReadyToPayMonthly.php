<?php

declare(strict_types=1);

namespace App\Model\Credit\Entity\Bid\BidRequest;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class ReadyToPayMonthly
{
    /**
     * @ORM\Column(type="integer")
     */
    private int $readyToPayMonthly;

    public function __construct(int $readyToPayMonthly)
    {
        $this->readyToPayMonthly = $readyToPayMonthly;
    }
}
