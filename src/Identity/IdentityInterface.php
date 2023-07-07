<?php

/**
 * @see https://github.com/dotkernel/dot-authentication/ for the canonical source repository
 */

declare(strict_types=1);

namespace Dot\Authentication\Identity;

/**
 * Interface IdentityInterface
 */
interface IdentityInterface
{
    /**
     * @return mixed
     */
    public function getId();

    public function getName(): string;
}
