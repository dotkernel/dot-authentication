<?php

declare(strict_types=1);

namespace Dot\Authentication;

use Dot\Authentication\Identity\IdentityInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Interface AuthenticationInterface
 */
interface AuthenticationInterface
{
    /**
     * Get the unauthorized response with additional headers specific to the auth type
     * This usually means a 401 response with a www-authenticate header
     */
    public function challenge(ServerRequestInterface $request): ResponseInterface;

    public function authenticate(ServerRequestInterface $request): AuthenticationResult;

    /**
     * Check is there's an identity set
     */
    public function hasIdentity(): bool;

    /**
     * Gets the underlying stored identity object
     */
    public function getIdentity(): ?IdentityInterface;

    /**
     * Sets the identity directly, useful for auto-login
     */
    public function setIdentity(IdentityInterface $identity): IdentityInterface;

    /**
     * Clears the stored identity
     */
    public function clearIdentity(): void;
}
