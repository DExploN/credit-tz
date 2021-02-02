<?php

declare(strict_types=1);

namespace App\Model\Credit\Entity\Bid;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class BidIdType extends StringType
{
    public const NAME = 'bid_bid_id'; // modify to match your type name

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new BidId($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return (string)$value;
    }

    public function getName()
    {
        return self::NAME;
    }

}
