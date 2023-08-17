<?php

declare(strict_types=1);

namespace Dot\Authentication;

use Dot\Authentication\Identity\IdentityInterface;

class AuthenticationResult
{
    public const FAILURE                     = 0;
    public const SUCCESS                     = 1;
    public const FAILURE_INVALID_CREDENTIALS = -1;
    public const FAILURE_IDENTITY_AMBIGUOUS  = -2;
    public const FAILURE_IDENTITY_NOT_FOUND  = -3;
    public const FAILURE_UNCATEGORIZED       = -4;
    public const FAILURE_MISSING_CREDENTIALS = -5;

    protected int $code;

    protected ?IdentityInterface $identity = null;

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
