<?php

declare(strict_types=1);

namespace App\Model\Credit\Service\CreditCalculator\Programs;

use App\Model\Credit\Service\CreditCalculator\CreditCondition;
use App\Model\Credit\Service\CreditCalculator\InputData;

/**
 * Условия из ТЗ
 * Class FirstProgram
 * @package App\Model\Credit\Service\CreditCalculator\Programs
 */
class FirstProgram implements ICreditProgram
{
    public function support(InputData $data): bool
    {
        if (($data->getInitialFee() >= 200000) && $data->getMonthlyFee() <= 10000 && $data->getCreditTerm() <= 60) {
            return true;
        }
        return false;
    }
    public function calculate(InputData $data): CreditCondition
    {
        return new CreditCondition(9800 * $data->getCreditTerm(), 12.8, 9800);
    }

    public function getPriority(): int
    {
        return 1;
    }
}
