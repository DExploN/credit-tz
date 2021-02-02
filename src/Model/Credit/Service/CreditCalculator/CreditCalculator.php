<?php

declare(strict_types=1);

namespace App\Model\Credit\Service\CreditCalculator;

use App\Model\Credit\Exception\CreditProgramNotFoundException;
use App\Model\Credit\Service\CreditCalculator\Programs\ICreditProgram;
use SplPriorityQueue;

class CreditCalculator
{
    private $programs;

    /**
     * CreditCalculator constructor.
     * @param ICreditProgram[] $programs
     */
    public function __construct(iterable $programs)
    {
        $this->programs = new SplPriorityQueue();
        foreach ($programs as $program) {
            $this->programs->insert($program, $program->getPriority());
        }
    }

    public function calculate(CreditRequest $inputData): CreditTerm
    {
        /** @var ICreditProgram[] $programs */
        $programs = iterator_to_array($this->programs);
        foreach ($programs as $program) {
            if ($program->support($inputData)) {
                return $program->calculate($inputData);
            }
        }
        throw new CreditProgramNotFoundException("Кредитная программа не найдена");
    }
}
