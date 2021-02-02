<?php

declare(strict_types=1);

namespace App\ReadModel\Customer\Credit\UseCase\GetProgram;

use App\ArgumentResolver\IResolvedFromRequest;
use Symfony\Component\Validator\Constraints as Assert;

class Query implements IResolvedFromRequest
{
    /**
     * @Assert\NotBlank()
     * @Assert\Type(type="integer")
     */
    public int $totalPrice;
    /**
     * @Assert\NotBlank()
     * @Assert\Type(type="integer")
     */
    public int $initialFee;
    /**
     * @Assert\NotBlank()
     * @Assert\Type(type="integer")
     */
    public int $readyToPayMonthly;
    /**
     * @Assert\NotBlank()
     * @Assert\Type(type="integer")
     */
    public int $creditTime;
}
