<?php
namespace App\Exception;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class JsonExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        $data = [
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
        ];

        $response = new JsonResponse($data);

        $event->setResponse($response);
    }
}

