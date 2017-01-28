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
 * Interface AuthenticationInterface
 * @package Dot\Authentication
 */
interface AuthenticationInterface
{
    /**
     * Get the unauthorized response with additional headers specific to the auth type
     * This usually means a 401 response with a www-authenticate header
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function challenge(ServerRequestInterface $request, ResponseInterface $response) : ResponseInterface;

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return AuthenticationResult
     */
    public function authenticate(ServerRequestInterface $request, ResponseInterface $response) : AuthenticationResult;

    /**
     * Check is there's an identity set
     *
     * @return bool
     */
    public function hasIdentity() : bool;

    /**
     * Gets the underlying stored identity object
     *
     * @return IdentityInterface
     */
    public function getIdentity() : IdentityInterface;

    /**
     * Sets the identity directly, useful for auto-login
     *
     * @param IdentityInterface $identity
     * @return mixed
     */
    public function setIdentity(IdentityInterface $identity);

    /**
     * Clears the stored identity
     *
     * @return void
     */
    public function clearIdentity();
}
