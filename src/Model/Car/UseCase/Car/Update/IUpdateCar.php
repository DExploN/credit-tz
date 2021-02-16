<?php

declare(strict_types=1);

namespace App\Model\Car\UseCase\Car\Update;

interface IUpdateCar
{
    public function __invoke(Command $command);
}
