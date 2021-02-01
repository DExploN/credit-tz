<?php

declare(strict_types=1);

namespace App\ArgumentResolver;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * Class RequestFillArgumentResolver заполняет DTO из запроса
 * @package App\ArgumentResolver
 */
class RequestFillArgumentResolver implements ArgumentValueResolverInterface
{

    public function supports(Request $request, ArgumentMetadata $argument)
    {
        $type = $argument->getType();
        if ($type === null) {
            return false;
        }
        $reflection = new \ReflectionClass($argument->getType());
        if ($reflection->implementsInterface(IResolvedFromRequest::class)) {
            return true;
        }
        return false;
    }

    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        $normalizer = new ObjectNormalizer();
        $data = [];
        if (stripos($argument->getName(), 'filter') !== false) {
            $data = array_merge($data, $request->query->all());
        }
        if (stripos($argument->getName(), 'multipart') !== false) {
            $data = array_merge($data, $request->request->all());
            $data = array_merge($data, $request->files->all());
        }
        if (stripos($argument->getName(), 'json') !== false) {
            $decoded = json_decode($request->getContent(), true);
            if (is_array($decoded)) {
                $data = array_merge($data, $decoded);
            }
        }
        yield $normalizer->denormalize($data, $argument->getType());
    }
}
