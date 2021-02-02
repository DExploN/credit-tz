<?php

declare(strict_types=1);

namespace App\Model\Credit\Service\CreditCalculator\Programs;

use App\Model\Credit\Service\CreditCalculator\CreditRequest;
use App\Model\Credit\Service\CreditCalculator\CreditTerm;

/**
 * Условия из ТЗ
 * Class FirstProgram
 * @package App\Model\Credit\Service\CreditCalculator\Programs
 */
class FirstProgram implements ICreditProgram
{
    public function support(CreditRequest $data): bool
    {
        if (($data->getInitialFee() >= 200000) && $data->getReadyToPayMonthly() <= 10000 && $data->getCreditTime(
            ) <= 60) {
            return true;
        }
        return false;
    }

    public function calculate(CreditRequest $data): CreditTerm
    {
        return new CreditTerm(9800 * $data->getCreditTime(), 12.8, 9800);
    }

    public function getPriority(): int
    {
        return 1;
    }
}
