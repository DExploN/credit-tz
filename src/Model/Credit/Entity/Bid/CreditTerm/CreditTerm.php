<?php

declare(strict_types=1);

namespace App\Model\Credit\Entity\Bid\CreditTerm;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class CreditTerm
{

    /**
     * @ORM\Embedded(columnPrefix=false, class="TotalPayment")
     */
    private TotalPayment $totalPayment;
    /**
     * @ORM\Embedded(columnPrefix=false, class="MonthlyFee")
     */
    private MonthlyFee $monthlyFee;
    /**
     * @ORM\Embedded(columnPrefix=false, class="InterestRate")
     */
    private InterestRate $interestRate;

    public function __construct(int $totalPayment, int $monthlyFee, string $interestRate)
    {
        $this->totalPayment = new TotalPayment($totalPayment);
        $this->monthlyFee = new MonthlyFee($monthlyFee);
        $this->interestRate = new InterestRate($interestRate);
    }
}
