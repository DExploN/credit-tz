<?php

declare(strict_types=1);

namespace App\Model\Credit\UseCase\Bid\Create;

use App\ArgumentResolver\IResolvedFromRequest;
use Symfony\Component\Validator\Constraints as Assert;

class Command implements IResolvedFromRequest
{
    /**
     * @Assert\NotBlank()
     */
    public string $bid;
    /**
     * @Assert\NotBlank()
     */
    public string $car;
    /**
     * @Assert\NotBlank()
     */
    public int $initialFee;
    /**
     * @Assert\NotBlank()
     */
    public int $readyToPayMonthly;
    /**
     * @Assert\NotBlank()
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
