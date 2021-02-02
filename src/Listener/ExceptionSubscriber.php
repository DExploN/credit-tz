<?php

declare(strict_types=1);

namespace App\Listener;

use App\Exception\DomainException;
use App\Exception\ValidateException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Messenger\Exception as MessengerException;
use Symfony\Component\Messenger\Exception\ValidationFailedException;
use Symfony\Component\Validator\ConstraintViolationInterface;

class ExceptionSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => [
                ['formatValidateException', 10],
                ['formatMessengerValidationFailedException', 20],
                ['HandlerFailedException', 20],
            ]
        ];
    }

    /**
     * Преобразование исключения валидации в response
     * @param ExceptionEvent $event
     */
    public function formatValidateException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        if ($exception instanceof DomainException) {
            $messages = [];
            if ($exception instanceof ValidateException) {
                $messages = $exception->getMessages();
            } else {
                $messages['error'] = $exception->getMessage();
            }
            $response = $event->getResponse();
            if ($response === null) {
                $response = new JsonResponse();
            }
            $response->setStatusCode(400);
            $response->setContent(
                json_encode(
                    [
                        'code' => 400,
                        'messages' => $messages
                    ]
                )
            );
            $event->setResponse($response);
        }
    }

    /**
     * Преобразование исключения мессенджера в DomainException
     * @param ExceptionEvent $event
     */
    public function HandlerFailedException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        if ($exception instanceof MessengerException\HandlerFailedException) {
            /** @var ValidationFailedException[] $validateExceptions */
            $validateExceptions = $exception->getNestedExceptionOfClass(DomainException::class);
            if (count($validateExceptions)) {
                $event->setThrowable($validateExceptions[0]);
            }
        }
    }

    /**
     * Преобразование исключение валидации мессенджера, в DomainValidationException
     * @param ExceptionEvent $event
     */
    public function formatMessengerValidationFailedException(ExceptionEvent $event)
    {
        $validateException = $event->getThrowable();
        if ($validateException instanceof MessengerException\ValidationFailedException) {
            $errorList = [];
            /** @var ConstraintViolationInterface $error */
            foreach ($validateException->getViolations() as $error) {
                $errorList[] = ['message' => $error->getMessage(), 'property' => $error->getPropertyPath()];
            }
            $event->setThrowable(new ValidateException($errorList));
        }
    }
}
