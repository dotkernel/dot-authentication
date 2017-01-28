<?php
/**
 * @copyright: DotKernel
 * @library: dotkernel/dot-authentication
 * @author: n3vrax
 * Date: 9/6/2016
 * Time: 7:49 PM
 */

namespace Dot\Authentication;

use Dot\Authentication\Identity\IdentityInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class AuthenticationResult
 * @package Dot\Authentication
 */
class AuthenticationResult
{
    const FAILURE = 0;

    const SUCCESS = 1;

    const FAILURE_INVALID_CREDENTIALS = -1;

    const FAILURE_IDENTITY_AMBIGUOUS = -2;

    const FAILURE_IDENTITY_NOT_FOUND = -3;

    const FAILURE_UNCATEGORIZED = -4;

    const FAILURE_MISSING_CREDENTIALS = -5;

    /**
     * Authentication result code
     *
     * @var int
     */
    protected $code;

    /**
     * @var IdentityInterface
     */
    protected $identity;

    /**
     * string messages describing the auth failure
     *
     * @var string
     */
    protected $message = '';

    /**
     * The modified response that should be returned to user
     *
     * @var ResponseInterface
     */
    protected $response;

    /**
     * The request object as received or with possible modifications
     *
     * @var ServerRequestInterface
     */
    protected $request;

    /**
     * AuthenticationResult constructor.
     * @param $code
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param IdentityInterface|null $identity
     * @param string $message
     */
    public function __construct(
        int $code,
        ServerRequestInterface $request,
        ResponseInterface $response,
        IdentityInterface $identity = null,
        $message = null
    ) {
        $this->code = (int)$code;
        $this->identity = $identity;
        $this->message = $message;
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @return bool
     */
    public function isValid() : bool
    {
        return ($this->code > 0);
    }

    /**
     * @return int
     */
    public function getCode() : int
    {
        return $this->code;
    }

    /**
     * @return IdentityInterface
     */
    public function getIdentity() : IdentityInterface
    {
        return $this->identity;
    }

    /**
     * @return string
     */
    public function getMessage() : string
    {
        return $this->message;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse() : ResponseInterface
    {
        return $this->response;
    }

    /**
     * @return ServerRequestInterface
     */
    public function getRequest() : ServerRequestInterface
    {
        return $this->request;
    }
}
