<?php

declare(strict_types=1);

namespace App\Exception;

use Throwable;

class ValidateException extends DomainException
{
    private array $messages;

    public function __construct(array $messages, Throwable $previous = null)
    {
        parent::__construct('', 400, $previous);
        $this->messages = $messages;
    }

    /**
     * @return array
     */
    public function getMessages(): array
    {
        return $this->messages;
    }
}
