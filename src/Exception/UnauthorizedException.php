<?php

/**
 * @see https://github.com/dotkernel/dot-authentication/ for the canonical source repository
 */

declare(strict_types=1);

namespace Dot\Authentication\Exception;

use Exception;

class UnauthorizedException extends Exception implements ExceptionInterface
{
    public function __construct(string $message = "", int $code = 401, ?Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
