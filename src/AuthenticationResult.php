<?php

declare(strict_types=1);

namespace Dot\Authentication;

use Dot\Authentication\Identity\IdentityInterface;

class AuthenticationResult
{
    protected const FAILURE                     = 0;
    protected const SUCCESS                     = 1;
    protected const FAILURE_INVALID_CREDENTIALS = -1;
    protected const FAILURE_IDENTITY_AMBIGUOUS  = -2;
    protected const FAILURE_IDENTITY_NOT_FOUND  = -3;
    protected const FAILURE_UNCATEGORIZED       = -4;
    protected const FAILURE_MISSING_CREDENTIALS = -5;

    protected int $code;

    protected IdentityInterface $identity;

    protected string $message = '';

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

    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    public function getIdentity(): ?IdentityInterface
    {
        return $this->identity;
    }

    public function setIdentity(IdentityInterface $identity): void
    {
        $this->identity = $identity;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }
}
