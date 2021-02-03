<?php

declare(strict_types=1);

namespace App\Model\Car\Entity\Car;

use App\Model\Car\Entity\Brand\Brand;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="car_cars")
 */
class Car
{
    /**
     * @ORM\Id
     * @ORM\Column(type="car_car_id", unique=true)
     */
    private CarId $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $model;

    /**
     * @ORM\Embedded(class="Image", columnPrefix="image_")
     */
    private ?Image $image;

    /**
     * @ORM\ManyToOne(targetEntity=Brand::class, inversedBy="cars")
     * @ORM\JoinColumn(nullable=false)
     */
    private $brand;

    /**
     * @ORM\Embedded(class="Price", columnPrefix="price_")
     */
    private Price $price;

    public function __construct(CarId $carId, string $model, Brand $brand)
    {
        $this->id = $carId;
        $this->model = $model;
        $this->brand = $brand;
        $this->price = new Price();
    }

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function changeBrand(Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function changeImage(?Image $image): void
    {
        $this->image = $image;
    }

    public function changePrice(Price $price): void
    {
        $this->price = $price;
    }

    /**
     * @return CarId
     */
    public function getId(): CarId
    {
        return $this->id;
    }

    public function changeModel(string $model): void
    {
        $this->model = $model;
    }


}
