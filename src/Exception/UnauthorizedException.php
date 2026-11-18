<?php

declare(strict_types=1);

namespace Dot\Authentication\Exception;

use Exception;
use Throwable;

class UnauthorizedException extends Exception implements ExceptionInterface
{
    public function __construct(string $message = "", int $code = 401, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
