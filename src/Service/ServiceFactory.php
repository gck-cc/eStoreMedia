<?php

declare(strict_types = 1);

namespace Core\Service;

use Core\HttpClient\GuzzleHttpClient;
use Core\Page\EStoreMediaPage;
use Core\Parser\DefaultParser;
use GuzzleHttp\Client;

class ServiceFactory
{
    public static function create(): Task1
    {
        $guzzleClient = new Client();
        $httpClient = new GuzzleHttpClient($guzzleClient);

        $parser = new DefaultParser();

        $page = new EStoreMediaPage();

        return new Task1($httpClient, $page, $parser);
    }
}
