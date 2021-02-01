<?php

declare(strict_types=1);

namespace App\Controller\Customer;

use App\ReadModel\Customer\Car\Fetcher\CarFetcher;
use App\ReadModel\Customer\Car\Fetcher\Filter\ListFilter;
use App\Service\UrlNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
