<?php

declare(strict_types=1);

namespace App\Model\Car\UseCase\Car\ChangeImage;

use App\ArgumentResolver\IResolvedFromRequest;
use App\Messenger\Message\ISyncMessage;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

class Command implements IResolvedFromRequest, ISyncMessage
{
    /**
     * @Assert\NotBlank
     * @Assert\Image()
     */
    public UploadedFile $image;

    /**
     * @var @Assert\NotBlank
     */
    public $id;
}
