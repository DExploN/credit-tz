<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\DomainException;
use League\Flysystem\Config;
use League\Flysystem\FilesystemOperator;
use League\Flysystem\Visibility;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileManager
{
    /**
     * @var FilesystemOperator
     */
    private FilesystemOperator $defaultStorage;

    public function __construct(FilesystemOperator $defaultStorage)
    {
        $this->defaultStorage = $defaultStorage;
    }

    public function uploadFile(UploadedFile $file, string $directory, string $name): string
    {
        if ($file->isValid()) {
            $relativePath = $directory . DIRECTORY_SEPARATOR . $name . '.' . $file->getClientOriginalExtension();
            $this->defaultStorage->write(
                $relativePath,
                file_get_contents($file->getRealPath()),
                [
                    Config::OPTION_DIRECTORY_VISIBILITY => Visibility::PUBLIC,
                    Config::OPTION_VISIBILITY => Visibility::PUBLIC
                ]
            );
            return $relativePath;
        } else {
            throw new DomainException("Ошибка при загрузке файла");
        }
    }
}
