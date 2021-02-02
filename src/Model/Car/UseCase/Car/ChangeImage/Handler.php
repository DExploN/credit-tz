<?php

declare(strict_types=1);

namespace App\Model\Car\UseCase\Car\ChangeImage;

use App\Model\Car\Entity\Car\CarId;
use App\Model\Car\Entity\Car\Image;
use App\Model\Car\Repository\CarRepository;
use App\Model\Car\Service\CarImageManager;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class Handler implements MessageHandlerInterface
{
    /**
     * @var CarImageManager
     */
    private CarImageManager $imageManager;
    /**
     * @var CarRepository
     */
    private CarRepository $cars;

    public function __construct(CarImageManager $imageManager, CarRepository $cars)
    {
        $this->imageManager = $imageManager;
        $this->cars = $cars;
    }

    public function __invoke(Command $command)
    {
        $car = $this->cars->get(new CarId($command->id));
        // Todo сделать с какой-либо абстракцией
        $path = 'cars/' . $command->id . '/image.' . $command->image->guessClientExtension();
        $this->imageManager->savefromUpload($command->image, $path);
        $car->changeImage(new Image($path));
        $this->cars->save($car);
    }
}
