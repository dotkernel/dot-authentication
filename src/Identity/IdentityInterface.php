<?php

declare(strict_types=1);

namespace Dot\Authentication\Identity;

/**
 * Interface IdentityInterface
 */
interface IdentityInterface
{
    public function getId(): mixed;

    public function getName(): string;
}
