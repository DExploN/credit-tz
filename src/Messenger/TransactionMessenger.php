<?php

declare(strict_types=1);

namespace App\Messenger;

use Doctrine\DBAL\Connection;
use Symfony\Component\Messenger\MessageBusInterface;

class TransactionMessenger implements IMessenger
{
    /**
     * @var MessageBusInterface
     */
    private MessageBusInterface $bus;
    /**
     * @var Connection
     */
    private Connection $connection;

    public function __construct(MessageBusInterface $bus, Connection $connection)
    {
        $this->bus = $bus;
        $this->connection = $connection;
    }

    public function dispatch(array $messages): void
    {
        $this->connection->transactional(
            function () use ($messages) {
                foreach ($messages as $message) {
                    $this->bus->dispatch($message);
                }
            }
        );
    }
}
