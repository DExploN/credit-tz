<?php

declare(strict_types=1);

namespace App\Listener;

use App\Exception\ValidateException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [KernelEvents::EXCEPTION => 'formatValidateException'];
    }

    /**
     * Преобразование исключения валидации в response
     * @param ExceptionEvent $event
     */
    public function formatValidateException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        if ($exception instanceof ValidateException) {
            $response = $event->getResponse();
            if ($response === null) {
                $response = new JsonResponse();
            }
            $response->setStatusCode(400);
            $response->setContent(
                json_encode(
                    [
                        'code' => 400,
                        'messages' => $exception->getMessages()
                    ]
                )
            );
            $event->setResponse($response);
        }
    }
}
