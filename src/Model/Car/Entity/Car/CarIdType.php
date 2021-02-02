<?php

declare(strict_types=1);

namespace App\Model\Car\Entity\Car;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class CarIdType extends StringType
{
    public const NAME = 'car_car_id'; // modify to match your type name

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new CarId($value);
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
