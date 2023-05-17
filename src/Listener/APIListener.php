<?php

namespace VTGianni\OopsBundle\Listener;

use Symfony\Component\HttpKernel\Event\ResponseEvent;
use VTGianni\OopsBundle\Service\OopsService;

class APIListener
{
    private OopsService $service;
    private string $apiUrl;
    private bool $apiListen;

    public function __construct(OopsService $service, string $apiUrl, string $apiListen)
    {
        $this->service = $service;
        $this->apiUrl = $apiUrl;
        $this->apiListen = $apiListen === 'true';
    }

    public function onKernelResponse(ResponseEvent $event)
    {
        $request = $event->getRequest();
        $response = $event->getResponse();

        if ($this->apiListen && strpos($request->getUri(), $this->apiUrl) === 0 && $response->getStatusCode() >= 400) {
            $this->service->reportError(
                $request->getUri(),
                $response->getStatusCode(),
                "Error {$response->getStatusCode()}",
                $request->headers->all(),
                $request->toArray(),
                [$response->getContent()]
            );
        }
    }
}