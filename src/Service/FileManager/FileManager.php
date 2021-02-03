<?php

declare(strict_types=1);

namespace App\Service\FileManager;

use App\Exception\DomainException;
use League\Flysystem\Config;
use League\Flysystem\FilesystemOperator;
use League\Flysystem\Visibility;
use Ramsey\Uuid\Uuid;
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

    public function uploadFile(UploadedFile $file, string $directory, ?string $name = null)
    {
        if ($file->isValid()) {
            $name = $name ?? Uuid::uuid4()->toString();
            $name .= '.' . $file->getClientOriginalExtension();
            $relativePath = $directory . DIRECTORY_SEPARATOR . $name;
            $this->defaultStorage->write(
                $relativePath,
                file_get_contents($file->getRealPath()),
                [
                    Config::OPTION_DIRECTORY_VISIBILITY => Visibility::PUBLIC,
                    Config::OPTION_VISIBILITY => Visibility::PUBLIC
                ]
            );
            return new File(
                $relativePath, $name, $file->getClientOriginalName(), $file->getSize(), $file->getMimeType()
            );
        } else {
            throw new DomainException("Ошибка при загрузке файла");
        }
    }

    public function deleteDirectory(string $relativePath)
    {
        if (!empty($relativePath)) {
            $this->defaultStorage->deleteDirectory($relativePath);
        }
    }
}
