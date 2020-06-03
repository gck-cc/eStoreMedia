<?php

declare(strict_types = 1);

namespace Core\HttpClient;

interface HttpClient
{
    public const GET = 'GET';
    public const STATUS_OK = 200;

    public function get(string $url): string;
}
