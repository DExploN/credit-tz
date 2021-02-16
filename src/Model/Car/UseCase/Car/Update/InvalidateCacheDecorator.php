<?php

declare(strict_types=1);

namespace App\Model\Car\UseCase\Car\Update;

use Symfony\Contracts\Cache\CacheInterface;

class InvalidateCacheDecorator implements IUpdateCar
{

    /**
     * @var IUpdateCar
     */
    private IUpdateCar $handler;
    /**
     * @var CacheInterface
     */
    private CacheInterface $cache;

    public function __construct(IUpdateCar $handler, CacheInterface $cache)
    {
        $this->handler = $handler;
        $this->cache = $cache;
    }

    public function __invoke(Command $command)
    {
        $handler = $this->handler;
        $handler($command);
        $this->cache->delete("car_{$command->id}");
    }
}
