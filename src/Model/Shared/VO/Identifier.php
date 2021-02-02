<?php

declare(strict_types=1);

namespace App\Model\Shared\VO;

interface Identifier
{
    public function __toString();

    public function __construct(string $uuid);
}
