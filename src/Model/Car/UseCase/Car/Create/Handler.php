<?php

declare(strict_types=1);

namespace App\Model\Car\UseCase\Car\Create;

use App\Model\Car\Entity\Brand\BrandId;
use App\Model\Car\Entity\Car\Car;
use App\Model\Car\Entity\Car\CarId;
use App\Model\Car\Entity\Car\Price;
use App\Model\Car\Repository\BrandRepository;
use App\Model\Car\Repository\CarRepository;
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

    public function __construct(CarRepository $cars, BrandRepository $brands)
    {
        $this->cars = $cars;
        $this->brands = $brands;
    }

    public function __invoke(Command $command)
    {
        $brand = $this->brands->get(new BrandId($command->brand));
        $car = new Car(new CarId($command->id), $command->model, $brand);
        $car->changePrice(new Price($command->price));
        $this->cars->add($car);
    }
}
