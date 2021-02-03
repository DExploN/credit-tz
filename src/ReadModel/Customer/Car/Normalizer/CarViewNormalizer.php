<?php

declare(strict_types=1);

namespace App\ReadModel\Customer\Car\Normalizer;

use App\ReadModel\Customer\Car\View\CarView;
use App\Service\UrlNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CarViewNormalizer implements NormalizerInterface
{

    /**
     * @var UrlNormalizer
     */
    private UrlNormalizer $normalizer;

    public function __construct(UrlNormalizer $normalizer)
    {
        $this->normalizer = $normalizer;
    }

    /**
     * @param CarView $object
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        $object->imagePath = empty($object->imagePath) ? null : $this->normalizer->getPublicUrl($object->imagePath);
        return $object;
    }

    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof CarView;
    }
}
