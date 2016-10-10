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
     * @var string|null
     */
    protected $message;

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
        $code,
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
    public function isValid()
    {
        return ($this->code > 0);
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return IdentityInterface
     */
    public function getIdentity()
    {
        return $this->identity;
    }

    /**
     * @return array
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return ServerRequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }

}