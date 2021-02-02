<?php

declare(strict_types=1);

namespace App\Model\Car\Entity\Car;

use App\Model\Shared\VO\Identifier;
use Webmozart\Assert\Assert;

class CarId implements Identifier
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
