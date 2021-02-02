<?php

declare(strict_types=1);

namespace App\Model\Credit\Entity\Bid\CreditTerm;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class InterestRate
{
    /**
     * @ORM\Column(type="decimal", precision=3, scale=1)
     */
    private $interestRate;

    public function __construct(string $interestRate)
    {
        $this->interestRate = $interestRate;
    }
}
