<?php

declare(strict_types=1);

namespace App\Model\Credit\Entity\Bid\CreditTerm;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class TotalPayment
{
    /**
     * @ORM\Column(type="integer")
     */
    private $totalPayment;

    public function __construct(int $totalPayment)
    {
        $this->totalPayment = $totalPayment;
    }
}
