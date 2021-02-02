<?php

declare(strict_types=1);

namespace App\Model\Credit\Service\CreditCalculator\Programs;

use App\Model\Credit\Service\CreditCalculator\CreditRequest;
use App\Model\Credit\Service\CreditCalculator\CreditTerm;

/**
 * Просто программа-заглушка
 * Class FirstProgram
 * @package App\Model\Credit\Service\CreditCalculator\Programs
 */
class OtherProgram implements ICreditProgram
{
    public function support(CreditRequest $data): bool
    {
        return true;
    }

    public function calculate(CreditRequest $data): CreditTerm
    {
        return new CreditTerm(10000 * $data->getCreditTime(), 30.0, 10000);
    }

    public function getPriority(): int
    {
        return 0;
    }
}
