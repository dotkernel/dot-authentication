<?php

/**
 * @see https://github.com/dotkernel/dot-authentication/ for the canonical source repository
 */

declare(strict_types=1);

namespace Dot\Authentication;

use Dot\Authentication\Identity\IdentityInterface;

class AuthenticationResult
{
/**
 * Authentication result code
 *
 * @var int
 */
    protected $code;
/** @var IdentityInterface */
    protected $identity;
/**
 * string messages describing the auth failure
 *
 * @var string
 */
    protected $message = '';

    public function __construct(int $code, string $message = '', ?IdentityInterface $identity = null)
    {
        $this->code     = $code;
        $this->identity = $identity;
        $this->message  = $message;
    }

    public function isValid(): bool
    {
        return $this->code > 0;
    }

    public function hasIdentity(): bool
    {
        return $this->identity instanceof IdentityInterface;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function setCode(int $code)
    {
        $this->code = $code;
    }

    public function getIdentity(): ?IdentityInterface
    {
        return $this->identity;
    }

    public function setIdentity(IdentityInterface $identity)
    {
        $this->identity = $identity;
    }

    public function getMessage(): string
    {
        return $this->message ?? '';
    }

    public function setMessage(string $message)
    {
        $this->message = $message;
    }
}
