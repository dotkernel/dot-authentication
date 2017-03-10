<?php
/**
 * @see https://github.com/dotkernel/dot-authentication/ for the canonical source repository
 * @copyright Copyright (c) 2017 Apidemia (https://www.apidemia.com)
 * @license https://github.com/dotkernel/dot-authentication/blob/master/LICENSE.md MIT License
 */

declare(strict_types = 1);

namespace Dot\Authentication\Exception;

use Exception;

/**
 * Class UnauthorizedException
 * @package Dot\Authentication\Exception
 */
class UnauthorizedException extends \Exception implements ExceptionInterface
{
    public function __construct($message = "", $code = 401, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
