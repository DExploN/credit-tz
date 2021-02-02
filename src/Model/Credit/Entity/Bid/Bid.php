<?php

namespace App\Model\Credit\Entity\Bid;

use App\Model\Credit\Entity\Bid\BidRequest\BidRequest;
use App\Model\Credit\Entity\Bid\CreditTerm\CreditTerm;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="credit_bits")
 * @ORM\Entity)
 */
class Bid
{
    /**
     * @ORM\Id
     * @ORM\Column(type="bid_bid_id")
     */
    private BidId $id;
    /**
     * @ORM\Embedded(columnPrefix="request_", class="App\Model\Credit\Entity\Bid\BidRequest\BidRequest")
     */
    private BidRequest $bidRequest;
    /**
     * @ORM\Embedded(columnPrefix="credit_term_", class="App\Model\Credit\Entity\Bid\CreditTerm\CreditTerm")
     */
    private CreditTerm $creditTerm;

    public function __construct(BidId $id, BidRequest $bidRequest, CreditTerm $creditTerm)
    {
        $this->id = $id;
        $this->bidRequest = $bidRequest;
        $this->creditTerm = $creditTerm;
    }


}
