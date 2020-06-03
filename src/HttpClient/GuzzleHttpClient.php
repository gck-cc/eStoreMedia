<?php

declare(strict_types = 1);

namespace Core\HttpClient;

use Core\HttpClient\Exception\HttpClientException;
use Core\HttpClient\Exception\HttpClientRequestException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

final class GuzzleHttpClient implements HttpClient
{
    private ClientInterface $httpClient;

    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function get(string $url): string
    {
        try {
            $resource = $this->httpClient->request(HttpClient::GET, $url);
        } catch (GuzzleException $e) {
            throw HttpClientRequestException::wrap((string) $e);
        }

        $html = $resource->getBody()->__toString();

        if (!is_string($html) || $resource->getStatusCode() !== HttpClient::STATUS_OK) {
            throw HttpClientException::wrap($url);
        }

        return $html;
    }
}
