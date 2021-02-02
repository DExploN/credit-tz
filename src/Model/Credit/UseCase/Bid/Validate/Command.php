<?php

declare(strict_types=1);

namespace App\Model\Credit\UseCase\Bid\Validate;

use App\ArgumentResolver\IResolvedFromRequest;
use Symfony\Component\Validator\Constraints as Assert;

class Command implements IResolvedFromRequest
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

    /**
     * @Assert\NotBlank()
     */
    public int $totalPayment;
    /**
     * @Assert\NotBlank()
     */
    public int $monthlyFee;
    /**
     * @Assert\NotBlank()
     */
    public string $interestRate;
}
