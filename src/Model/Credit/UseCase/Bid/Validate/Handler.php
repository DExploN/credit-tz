<?php

declare(strict_types=1);

namespace App\Model\Credit\UseCase\Bid\Validate;

use App\Exception\DomainException;
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

    public function __invoke(Command $command)
    {
        $inputData = new CreditRequest(
            $command->totalPrice,
            $command->initialFee,
            $command->readyToPayMonthly,
            $command->creditTime
        );
        $validTerm = $this->creditCalculator->calculate($inputData);

        $checkedTerm = new CreditTerm($command->totalPayment, (float)$command->interestRate, $command->monthlyFee);
        if ($validTerm->isEqual($checkedTerm) === false) {
            throw new DomainException("Not valid CreditTerm Bid");
        }
    }
}
