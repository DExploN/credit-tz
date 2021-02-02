<?php

declare(strict_types=1);

namespace App\Model\Credit\Entity\Bid\BidRequest;

use Webmozart\Assert\Assert;

class CarId
{
    /**
     * @var string
     */
    private string $value;

    public function __construct(string $id)
    {
        Assert::uuid($id);
        $this->value = $id;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
