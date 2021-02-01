<?php

namespace App\Model\Car\Entity\Brand;

use App\Repository\Model\Car\Entity\BrandRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BrandRepository::class)
 * @ORM\Table(name="car_brands")
 */
class Brand
{
    /**
     * @ORM\Id
     * @ORM\Column(type="brand_id")
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
