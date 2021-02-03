<?php

declare(strict_types=1);

namespace App\Model\Car\UseCase\Car\Delete;

use App\Model\Car\Entity\Car\CarId;
use App\Model\Car\Repository\CarRepository;
use App\Model\Car\Service\CarImageManager;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class Handler implements MessageHandlerInterface
{
    /**
     * @var CarRepository
     */
    private CarRepository $cars;
    /**
     * @var CarImageManager
     */
    private CarImageManager $imageManager;

    public function __construct(CarRepository $cars, CarImageManager $imageManager)
    {
        $this->cars = $cars;
        $this->imageManager = $imageManager;
    }

    public function __invoke(Command $command)
    {
        $car = $this->cars->get(new CarId($command->id));
        $this->cars->remove($car);
        $this->imageManager->removeImage($car->getId());
    }
}
