<?php

declare(strict_types=1);

namespace App\Messenger;

interface IMessenger
{
    public function dispatch(array $messages): void;
}
