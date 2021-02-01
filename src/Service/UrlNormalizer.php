<?php

declare(strict_types=1);

namespace App\Service;

class UrlNormalizer
{
    private string $hostName;

    public function __construct(string $hostName)
    {
        $this->hostName = $hostName;
    }

    public function getPublicUrl(string $path)
    {
        return "{$this->hostName}/storage/{$path}";
    }
}
