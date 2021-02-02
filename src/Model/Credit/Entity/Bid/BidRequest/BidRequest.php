<?php

declare(strict_types=1);

namespace App\Model\Credit\Entity\Bid\BidRequest;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 */
class BidRequest
{

    /**
     * @ORM\Column(type="bid_car_id", name="car_id")
     */
    private CarId $carId;
    /**
     * @ORM\Embedded(columnPrefix=false, class="InitialFee")
     */
    private InitialFee $initialFee;
    /**
     * @ORM\Embedded(columnPrefix=false, class="ReadyToPayMonthly")
     */
    private ReadyToPayMonthly $readyToPayMonthly;
    /**
     * @ORM\Embedded(columnPrefix=false, class="CreditTime")
     */
    private CreditTime $creditTime;

    public function __construct(CarId $carId, int $initialFee, int $readyToPayMonthly, int $creditTime)
    {
        $this->carId = $carId;
        $this->initialFee = new InitialFee($initialFee);
        $this->readyToPayMonthly = new ReadyToPayMonthly($readyToPayMonthly);
        $this->creditTime = new CreditTime($creditTime);
    }
}
