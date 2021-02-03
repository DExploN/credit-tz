<?php

declare(strict_types=1);

namespace App\ReadModel\Customer\Car\View;

class CarView
{
    public string $id;
    public string $model;
    public ?string $imagePath;
    public int $priceCent;
    public string $brandId;
    public string $brandName;
}
