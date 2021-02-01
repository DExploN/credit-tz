<?php

declare(strict_types=1);

namespace App\Model\Car\Entity\Brand;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class BrandIdType extends StringType
{
    public const NAME = 'brand_id'; // modify to match your type name

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new BrandId($value);
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
