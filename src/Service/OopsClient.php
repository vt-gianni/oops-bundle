<?php


namespace VTGianni\OopsBundle\Service;


use Exception;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class OopsClient
{
    private HttpClientInterface $client;
    private OopsService $service;

    public function __construct(HttpClientInterface $client, OopsService $service)
    {
        $this->client = $client;
        $this->service = $service;
    }

    /**
     * @param string $method
     * @param string $url
     * @param array $options
     * @return ResponseInterface
     * @throws TransportExceptionInterface
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws Exception
     */
    public function request(string $method, string $url, array $options = []): ResponseInterface
    {
        $response = $this->client->request($method, $url, $options);

        if ($response->getStatusCode() >= 400) {
            $this->service->reportError(
                $url,
                $response->getStatusCode(),
                "Error {$response->getStatusCode()}",
                $options['headers'] ?? [],
                $options['body'] ?? [],
                [$response->getContent(false)]
            );
        }

        return $response;
    }
}