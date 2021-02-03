<?php

declare(strict_types=1);

namespace App\Service\FileManager;

class File
{
    private $path;
    private $name;
    private $size;
    private $originalName;
    private $mimeType;

    public function __construct(string $path, string $name, string $originalName, int $size, string $mimeType)
    {
        $this->path = $path;
        $this->name = $name;
        $this->originalName = $originalName;
        $this->size = $size;
        $this->mimeType = $mimeType;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getMimeType(): string
    {
        return $this->mimeType;
    }
}
