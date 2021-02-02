<?php

declare(strict_types=1);

namespace App\Model\Shared\Dbal;


use App\Model\Shared\VO\Identifier;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Doctrine\DBAL\Types\Type;

class UuidIdentityType extends StringType
{
    public const NAME = 'brand_brand_id'; // modify to match your type name

    private string $name;
    private string $class;

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $class = $this->class;
        return new $class($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return (string)$value;
    }

    public function getName()
    {
        return $this->name;
    }

    public static function register(string $typeName, string $identityClass): bool
    {
        if (!Type::hasType($typeName)) {
            $reflection = new \ReflectionClass($identityClass);
            if ($reflection->implementsInterface(Identifier::class) === false) {
                throw new \LogicException("{$identityClass} is not identifier interface");
            }
            Type::addType($typeName, self::class);
            /** @var self $typeObject */
            $typeObject = Type::getType($typeName);
            $typeObject->class = $identityClass;
            $typeObject->name = $typeName;
            return true;
        }
        return false;
    }
}
