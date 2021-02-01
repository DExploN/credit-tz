<?php

declare(strict_types=1);

namespace App\Model\Credit\Service\CreditCalculator;

class InputData
{
    private int $totalPrice;
    private int $initialFee;
    private int $monthlyFee;
    private int $creditTerm;

    /**
     * InputData constructor.
     * @param int $totalPrice Цена автомобиля
     * @param int $initialFee Первоначальный взнос
     * @param int $monthlyFee Ежемесячная оплата
     * @param int $creditTerm Срок кредита
     */
    public function __construct(int $totalPrice, int $initialFee, int $monthlyFee, int $creditTerm)
    {
        $this->totalPrice = $totalPrice;
        $this->initialFee = $initialFee;
        $this->monthlyFee = $monthlyFee;
        $this->creditTerm = $creditTerm;
    }

    /**
     * @return int
     */
    public function getTotalPrice(): int
    {
        return $this->totalPrice;
    }

    /**
     * @return int
     */
    public function getInitialFee(): int
    {
        return $this->initialFee;
    }

    /**
     * @return int
     */
    public function getMonthlyFee(): int
    {
        return $this->monthlyFee;
    }

    /**
     * @return int
     */
    public function getCreditTerm(): int
    {
        return $this->creditTerm;
    }


}
