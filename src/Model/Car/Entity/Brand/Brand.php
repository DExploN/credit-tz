<?php

namespace App\Model\Car\Entity\Brand;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="car_brands")
 */
class Brand
{
    /**
     * @ORM\Id
     * @ORM\Column(type="car_brand_id")
     */
    private BrandId $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;


    public function __construct(BrandId $brandId, string $name)
    {
        $this->name = $name;
        $this->id = $brandId;
    }

}
