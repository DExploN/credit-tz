<?php

declare(strict_types=1);

namespace App\Model\Car\UseCase\Car\Create;

use App\Model\Car\Entity\Brand\BrandId;
use App\Model\Car\Entity\Car\Car;
use App\Model\Car\Entity\Car\CarId;
use App\Model\Car\Entity\Car\Image;
use App\Model\Car\Entity\Car\Price;
use App\Model\Car\Repository\BrandRepository;
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
     * @var BrandRepository
     */
    private BrandRepository $brands;
    /**
     * @var CarImageManager
     */
    private CarImageManager $imageManager;

    public function __construct(CarRepository $cars, BrandRepository $brands, CarImageManager $imageManager)
    {
        $this->cars = $cars;
        $this->brands = $brands;
        $this->imageManager = $imageManager;
    }

    public function __invoke(Command $command)
    {
        $brand = $this->brands->get(new BrandId($command->brand));
        $car = new Car(new CarId($command->id), $command->model, $brand);
        $car->changePrice(new Price($command->price));

        $file = $this->imageManager->saveFromUpload(
            $command->image,
            new CarId($command->id),
        );
        $car->changeImage(new Image($file->getPath()));

        $this->cars->add($car);
    }
}
