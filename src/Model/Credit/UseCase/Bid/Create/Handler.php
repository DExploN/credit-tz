<?php

declare(strict_types=1);

namespace App\Model\Credit\UseCase\Bid\Create;

use App\Model\Credit\Entity\Bid;
use App\Model\Credit\Repository\BidRepository;

class Handler
{
    /**
     * @var BidRepository
     */
    private BidRepository $bids;

    public function __construct(BidRepository $bids)
    {
        $this->bids = $bids;
    }

    public function __invoke(Command $command)
    {
        $bid = new Bid\Bid(
            new Bid\BidId($command->bid),
            new Bid\BidRequest\BidRequest(
                new Bid\BidRequest\CarId($command->car),
                $command->initialFee,
                $command->readyToPayMonthly,
                $command->creditTime
            ),
            new Bid\CreditTerm\CreditTerm(
                $command->totalPayment,
                $command->monthlyFee,
                $command->interestRate
            )
        );
        $this->bids->add($bid);
    }
}
