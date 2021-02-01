<?php

declare(strict_types=1);

namespace App\Model\Credit\Service\CreditCalculator;

class CreditCondition
{
    private int $totalPrice;
    private float $interestRate;
    private int $feePerMonth;

    public function __construct(int $totalPrice, float $interestRate, int $feePerMonth)
    {
        $this->totalPrice = $totalPrice;
        $this->interestRate = $interestRate;
        $this->feePerMonth = $feePerMonth;
    }

    /**
     * @return int
     */
    public function getTotalPrice(): int
    {
        return $this->totalPrice;
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

}
