<?php

declare(strict_types=1);

namespace App\ReadModel\Customer\Credit\UseCase\GetProgram;

use App\Model\Credit\Service\CreditCalculator\CreditCalculator;
use App\Model\Credit\Service\CreditCalculator\CreditRequest;
use App\Model\Credit\Service\CreditCalculator\CreditTerm;

class Handler
{
    /**
     * @var CreditCalculator
     */
    private CreditCalculator $creditCalculator;

    public function __construct(CreditCalculator $creditCalculator)
    {
        $this->creditCalculator = $creditCalculator;
    }

    public function __invoke(Query $query): CreditTerm
    {
        $inputData = new CreditRequest(
            $query->totalPrice,
            $query->initialFee,
            $query->monthlyFee,
            $query->creditTerm
        );
        return $this->creditCalculator->calculate($inputData);
    }
}
