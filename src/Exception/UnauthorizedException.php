<?php
/**
 * @copyright: DotKernel
 * @library: dotkernel/dot-authentication
 * @author: n3vrax
 * Date: 9/6/2016
 * Time: 7:49 PM
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
