<?php
/**
 * @copyright: DotKernel
 * @library: dotkernel/dot-authentication
 * @author: n3vrax
 * Date: 9/6/2016
 * Time: 7:49 PM
 */

declare(strict_types = 1);

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
     * @return ResponseInterface
     */
    public function challenge(ServerRequestInterface $request): ResponseInterface;

    /**
     * @param ServerRequestInterface $request
     * @return AuthenticationResult
     */
    public function authenticate(ServerRequestInterface $request): AuthenticationResult;

    /**
     * Check is there's an identity set
     *
     * @return bool
     */
    public function hasIdentity(): bool;

    /**
     * Gets the underlying stored identity object
     *
     * @return IdentityInterface
     */
    public function getIdentity(): IdentityInterface;

    /**
     * Sets the identity directly, useful for auto-login
     *
     * @param IdentityInterface $identity
     */
    public function setIdentity(IdentityInterface $identity);

    /**
     * Clears the stored identity
     */
    public function clearIdentity();
}
