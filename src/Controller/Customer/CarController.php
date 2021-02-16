<?php

declare(strict_types=1);

namespace App\Controller\Customer;

use App\Messenger\IMessenger;
use App\Model\Car\UseCase\Car\Create;
use App\Model\Car\UseCase\Car\Delete;
use App\Model\Car\UseCase\Car\Update;
use App\ReadModel\Customer\Car\Fetcher\CarFetcher;
use App\ReadModel\Customer\Car\Fetcher\Filter\ListFilter;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class CarController extends AbstractController
{
    /**
     * Список автомобилей
     * @Route("/api/customer/cars", methods={"GET"}, name="custimer_car_list")
     */
    public function carList(CarFetcher $carFetcher, ListFilter $listFilter)
    {
        return $this->json(
            $carFetcher->getCarList($listFilter)
        );
    }

    /**
     * Добавить автомобиль
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
     * Обновить автомобиль
     * @Route("/api/customer/cars/{id}/update", methods={"POST"}, name="custimer_car_update")
     */
    public function updateCar(
        $id,
        Update\Command $multipartUpdateCommand,
        IMessenger $bus
    ) {
        $multipartUpdateCommand->id = $id;
        $bus->dispatch([$multipartUpdateCommand]);
        return $this->json(['code' => 0], Response::HTTP_OK);
    }

    /**
     * Детальная информация об автомобиле
     * @Route("/api/customer/cars/{id}", methods={"GET"}, name="custimer_car_detail")
     */
    public function carDetail(
        string $id,
        CarFetcher $carFetcher,
        CacheInterface $cache
    ) {
        return $cache->get(
            "car_$id",
            function (ItemInterface $item) use ($carFetcher, $id) {
                $item->expiresAfter(100);
                return $this->json($carFetcher->getCar($id));
            }
        );
    }

    /**
     * Удаление автомобиля
     * @Route("/api/customer/cars/{id}", methods={"DELETE"}, name="custimer_car_delete")
     */
    public function deleteCar(
        string $id,
        IMessenger $bus
    ) {
        $bus->dispatch([new Delete\Command($id)]);
        return $this->json(['code' => 0], Response::HTTP_NO_CONTENT);
    }
}
