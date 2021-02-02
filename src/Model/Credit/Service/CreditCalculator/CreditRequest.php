<?php

declare(strict_types=1);

namespace App\Model\Credit\Service\CreditCalculator;

class CreditRequest
{
    private int $totalPrice;
    private int $initialFee;
    private int $readyToPayMonthly;
    private int $creditTime;

    /**
     * InputData constructor.
     * @param int $totalPrice Цена автомобиля
     * @param int $initialFee Первоначальный взнос
     * @param int $readyToPayMonthly Ожидаемая ежемесячная оплата
     * @param int $creditTime Срок кредита
     */
    public function __construct(int $totalPrice, int $initialFee, int $readyToPayMonthly, int $creditTime)
    {
        $this->totalPrice = $totalPrice;
        $this->initialFee = $initialFee;
        $this->readyToPayMonthly = $readyToPayMonthly;
        $this->creditTime = $creditTime;
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
    public function getReadyToPayMonthly(): int
    {
        return $this->readyToPayMonthly;
    }

    /**
     * @return int
     */
    public function getCreditTime(): int
    {
        return $this->creditTime;
    }


}
