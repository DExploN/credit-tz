<?php

namespace App\Tests;

use App\Model\Credit\Service\CreditCalculator\CreditRequest;
use App\Model\Credit\Service\CreditCalculator\Programs\FirstProgram;
use PHPUnit\Framework\TestCase;

class ProgramTest extends TestCase
{
    public function test_FirstProgram()
    {
        $firstProgram = new FirstProgram();
        self::assertTrue(
            $firstProgram->support(
                new CreditRequest(1000000, 200001, 10000, 50)
            )
        );

        self::assertFalse(
            $firstProgram->support(
                new CreditRequest(1000000, 200001, 10000, 61)
            )
        );

        self::assertFalse(
            $firstProgram->support(
                new CreditRequest(1000000, 200001, 11000, 50)
            )
        );

        self::assertFalse(
            $firstProgram->support(
                new CreditRequest(1000000, 100001, 10000, 50)
            )
        );
    }
}
