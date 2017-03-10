<?php
/**
 * @see https://github.com/dotkernel/dot-authentication/ for the canonical source repository
 * @copyright Copyright (c) 2017 Apidemia (https://www.apidemia.com)
 * @license https://github.com/dotkernel/dot-authentication/blob/master/LICENSE.md MIT License
 */

declare(strict_types = 1);

namespace Dot\Authentication;

use Dot\Authentication\Identity\IdentityInterface;

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
     * AuthenticationResult constructor.
     * @param $code
     * @param IdentityInterface|null $identity
     * @param string $message
     */
    public function __construct(
        int $code,
        string $message = '',
        IdentityInterface $identity = null
    ) {
        $this->code = (int)$code;
        $this->identity = $identity;
        $this->message = $message;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return ($this->code > 0);
    }

    /**
     * @return bool
     */
    public function hasIdentity(): bool
    {
        return $this->identity instanceof IdentityInterface;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param int $code
     */
    public function setCode(int $code)
    {
        $this->code = $code;
    }

    /**
     * @return IdentityInterface
     */
    public function getIdentity(): ?IdentityInterface
    {
        return $this->identity;
    }

    /**
     * @param IdentityInterface $identity
     */
    public function setIdentity(IdentityInterface $identity)
    {
        $this->identity = $identity;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message ?? '';
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
    }
}
