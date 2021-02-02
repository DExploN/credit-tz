<?php

declare(strict_types=1);

namespace App\Model\Car\UseCase\Car\Create;

use App\ArgumentResolver\IResolvedFromRequest;
use App\Messenger\Message\ISyncMessage;
use Symfony\Component\Validator\Constraints as Assert;

class Command implements IResolvedFromRequest, ISyncMessage
{
    /**
     * @Assert\NotBlank
     */
    public string $id;
    /**
     * @Assert\NotBlank
     */
    public string $brand;
    /**
     * @Assert\NotBlank
     */
    public string $model;
    /**
     * @Assert\NotBlank
     */
    public int $price;
}
