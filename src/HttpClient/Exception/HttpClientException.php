<?php

declare(strict_types = 1);

namespace Core\HttpClient\Exception;

use Exception;

final class HttpClientException extends Exception
{
    public static function wrap(string $e): self
    {
        return new self('Cannot load html from url: ' . $e);
    }
}
