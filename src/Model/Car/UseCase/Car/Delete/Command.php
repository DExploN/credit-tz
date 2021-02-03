<?php

declare(strict_types=1);

namespace App\Model\Car\UseCase\Car\Delete;

use App\Messenger\Message\ISyncMessage;
use Symfony\Component\Validator\Constraints as Assert;

class Command implements ISyncMessage
{
    /**
     * @Assert\NotBlank
     * @Assert\Uuid()
     */
    public string $id;

    /**
     * Command constructor.
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

}
