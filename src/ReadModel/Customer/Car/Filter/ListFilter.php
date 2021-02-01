<?php

declare(strict_types=1);

namespace App\ReadModel\Customer\Car\Filter;

use App\ArgumentResolver\IResolvedFromRequest;

class ListFilter implements IResolvedFromRequest
{
    public $brand;
    public $page;
    public $limit;
}
