<?php

declare(strict_types=1);

namespace App\Model\Credit\Entity\Bid\CreditTerm;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class MonthlyFee
{
    /**
     * @ORM\Column(type="integer")
     */
    private $monthlyFee;

    public function __construct(int $monthlyFee)
    {
        $this->monthlyFee = $monthlyFee;
    }
}
