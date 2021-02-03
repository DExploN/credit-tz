<?php

declare(strict_types=1);

namespace App\Controller\Customer;

use App\Messenger\IMessenger;
use App\Model\Car\UseCase\Car\Create;
use App\Model\Car\UseCase\Car\Delete\Command;
use App\ReadModel\Customer\Car\Fetcher\CarFetcher;
use App\ReadModel\Customer\Car\Fetcher\Filter\ListFilter;
use App\Service\UrlNormalizer;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    /**
     * Список автомобилей
     * @Route("/api/customer/cars", methods={"GET"}, name="custimer_car_list")
     */
    public function carList(CarFetcher $carFetcher, UrlNormalizer $normalizer, ListFilter $listFilter)
    {
        return $this->json(
                $carFetcher->getCarList($listFilter)
        );
    }

    /**
     * Список автомобилей
     * @Route("/api/customer/cars", methods={"POST"}, name="custimer_car_create")
     */
    public function createCar(
        IMessenger $bus,
        Create\Command $multipartCreateCommand
    ) {
        $multipartCreateCommand->id = Uuid::uuid6()->toString();
        $bus->dispatch([$multipartCreateCommand]);
        return $this->json(['code' => 0], Response::HTTP_CREATED);
    }

    /**
     * Детальная информация об автомобиле
     * @Route("/api/customer/cars/{id}", methods={"GET"}, name="custimer_car_detail")
     */
    public function carDetail(
        string $id,
        CarFetcher $carFetcher
    ) {
        return $this->json($carFetcher->getCar($id));
    }

    /**
     * Удаление автомобиля
     * @Route("/api/customer/cars/{id}", methods={"DELETE"}, name="custimer_car_delete")
     */
    public function deleteCar(
        string $id,
        IMessenger $bus
    ) {
        $bus->dispatch([new Command($id)]);
        return $this->json(['code' => 0], Response::HTTP_NO_CONTENT);
    }
}
