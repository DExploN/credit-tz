<?php

namespace App\Model\Car\Entity\Brand;

use App\Model\Shared\VO\Identifier;
use Webmozart\Assert\Assert;

class BrandId implements Identifier
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
