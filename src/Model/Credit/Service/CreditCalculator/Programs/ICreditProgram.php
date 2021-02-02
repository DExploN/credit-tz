<?php

declare(strict_types=1);

namespace App\Model\Credit\Service\CreditCalculator\Programs;

use App\Model\Credit\Service\CreditCalculator\CreditRequest;
use App\Model\Credit\Service\CreditCalculator\CreditTerm;

interface ICreditProgram
{
    public function support(CreditRequest $data): bool;

    public function calculate(CreditRequest $data): CreditTerm;

    public function getPriority(): int;
}
