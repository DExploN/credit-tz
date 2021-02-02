<?php

namespace App;

use App\Model\Shared\Dbal\UuidIdentityType;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->import('../config/{packages}/*.yaml');
        $container->import('../config/{packages}/' . $this->environment . '/*.yaml');

        if (is_file(\dirname(__DIR__) . '/config/services.yaml')) {
            $container->import('../config/services.yaml');
            $container->import('../config/{services}_' . $this->environment . '.yaml');
        } elseif (is_file($path = \dirname(__DIR__) . '/config/services.php')) {
            (require $path)($container->withPath($path), $this);
        }
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->import('../config/{routes}/' . $this->environment . '/*.yaml');
        $routes->import('../config/{routes}/*.yaml');

        if (is_file(\dirname(__DIR__) . '/config/routes.yaml')) {
            $routes->import('../config/routes.yaml');
        } elseif (is_file($path = \dirname(__DIR__) . '/config/routes.php')) {
            (require $path)($routes->withPath($path), $this);
        }
    }

    public function boot()
    {
        parent::boot();
        $this->identifiersInit();
    }

    private function identifiersInit(): void
    {
        if (file_exists(__DIR__ . '/../config/identifiers.php')) {
            $connection = $this->container->get('doctrine.orm.entity_manager')->getConnection();
            $identifiers = require __DIR__ . '/../config/identifiers.php';
            array_map(
                function ($type, $class) use ($connection) {
                    if (UuidIdentityType::register($type, $class)) {
                        $connection->getDatabasePlatform()->registerDoctrineTypeMapping($class, $type);
                    }
                },
                array_keys($identifiers),
                $identifiers
            );
        }
    }

}
