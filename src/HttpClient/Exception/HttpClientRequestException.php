<?php

declare(strict_types = 1);

namespace Core\HttpClient\Exception;

use Exception;
use Throwable;

final class HttpClientRequestException extends Exception
{
    public static function wrap(Throwable $e): self
    {
        return new self($e);
    }
}
