<?php

declare(strict_types=1);

namespace App\Model\Car\Service;

use App\Service\FileManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CarImageManager
{
    /**
     * @var FileManager
     */
    private FileManager $fileManager;

    public function __construct(FileManager $fileManager)
    {
        $this->fileManager = $fileManager;
    }

    public function savefromUpload(UploadedFile $file, string $relativePath)
    {
        $this->fileManager->uploadFile($file, $relativePath);
    }
}
