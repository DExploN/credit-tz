<?php

declare(strict_types=1);

namespace App\Controller\Customer;

use App\Messenger\IMessenger;
use App\Model\Car\UseCase\Car\Create;
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
            array_map(
                function (array $row) use ($normalizer) {
                    $row['imagePath'] = empty($row['imagePath']) ? null : $normalizer->getPublicUrl($row['imagePath']);
                    return $row;
                },
                $carFetcher->getCarList($listFilter)
            )
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
}
