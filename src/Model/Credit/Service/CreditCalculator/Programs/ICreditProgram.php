<?php

declare(strict_types=1);

namespace App\Model\Credit\Service\CreditCalculator\Programs;

use App\Model\Credit\Service\CreditCalculator\CreditCondition;
use App\Model\Credit\Service\CreditCalculator\InputData;

interface ICreditProgram
{
    public function support(InputData $data): bool;

    public function calculate(InputData $data): CreditCondition;

    public function getPriority(): int;
}
