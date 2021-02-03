<?php

declare(strict_types=1);

namespace App\Model\Car\Service;

use App\Model\Car\Entity\Car\CarId;
use App\Service\FileManager\File;
use App\Service\FileManager\FileManager;
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

    public function saveFromUpload(UploadedFile $file, CarId $carId): File
    {
        return $this->fileManager->uploadFile($file, "cars/{$carId}", 'image');
    }

    public function removeImage(CarId $carId)
    {
        $this->fileManager->deleteDirectory("cars/{$carId}");
    }
}
