<?php

declare(strict_types=1);

namespace App\Model\Credit\Entity\Bid\BidRequest;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class CreditTime
{
    /**
     * @ORM\Column(type="integer")
     */
    private int $creditTime;

    public function __construct(int $creditTime)
    {
        $this->creditTime = $creditTime;
    }
}
