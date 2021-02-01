<?php

declare(strict_types=1);

namespace App\ReadModel\Customer\Car\Fetcher;

use App\ReadModel\Customer\Car\Fetcher\Filter\ListFilter;
use Doctrine\DBAL\Connection;

class CarFetcher
{
    /**
     * @var Connection
     */
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Получение списка автомобилей
     * @param ListFilter $listFilter
     * @return array
     * @throws \Doctrine\DBAL\Exception
     */
    public function getCarList(ListFilter $listFilter): array
    {
        $page = (is_numeric($listFilter->page) && $listFilter->page > 0) ? $listFilter->page : 1;
        $limit = (is_numeric($listFilter->limit) && $listFilter->limit > 0) ? $listFilter->limit : 20;

        $qb = $this->connection->createQueryBuilder()->from('car_cars', 'cc')
            ->join('cc', 'car_brands', 'cb', 'cb.id = cc.brand_id')
            ->select('cc.id, cc.model, cc.image_path as imagePath, cc.price_cent as priceCent')
            ->addSelect('cb.id as brandId, cb.name as brandName');
        $qb->setFirstResult(($page - 1) * $limit);
        $qb->setMaxResults($limit);

        if ($listFilter->brand) {
            $qb->andWhere('cb.id = :brandId')->setParameter('brandId', $listFilter->brand);
        }
        return $qb->execute()->fetchAllAssociative();
    }


}
