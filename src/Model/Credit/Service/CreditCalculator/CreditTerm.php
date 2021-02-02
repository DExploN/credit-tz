<?php

declare(strict_types=1);

namespace App\Model\Credit\Service\CreditCalculator;

class CreditTerm
{
    private int $totalPayment;
    private float $interestRate;
    private int $feePerMonth;

    public function __construct(int $totalPayment, float $interestRate, int $feePerMonth)
    {
        $this->totalPayment = $totalPayment;
        $this->interestRate = $interestRate;
        $this->feePerMonth = $feePerMonth;
    }

    /**
     * @return int
     */
    public function getTotalPayment(): int
    {
        return $this->totalPayment;
    }

    /**
     * @return float
     */
    public function getInterestRate(): float
    {
        return $this->interestRate;
    }

    /**
     * @return int
     */
    public function getFeePerMonth(): int
    {
        return $this->feePerMonth;
    }

    public function isEqual(CreditTerm $creditTerm): bool
    {
        return $creditTerm->interestRate === $this->interestRate &&
            $creditTerm->totalPayment === $this->totalPayment &&
            $creditTerm->feePerMonth === $this->feePerMonth;
    }

}
