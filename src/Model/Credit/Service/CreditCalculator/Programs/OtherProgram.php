<?php

declare(strict_types=1);

namespace App\Model\Credit\Service\CreditCalculator\Programs;

use App\Model\Credit\Service\CreditCalculator\CreditCondition;
use App\Model\Credit\Service\CreditCalculator\InputData;

/**
 * Просто программа-заглушка
 * Class FirstProgram
 * @package App\Model\Credit\Service\CreditCalculator\Programs
 */
class OtherProgram implements ICreditProgram
{
    public function support(InputData $data): bool
    {
        return true;
    }

    public function calculate(InputData $data): CreditCondition
    {
        return new CreditCondition(10000 * $data->getCreditTerm(), 30.0, 10000);
    }

    public function getPriority(): int
    {
        return 0;
    }
}
