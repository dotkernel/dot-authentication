<?php

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
    public function getId(): mixed;

    public function getName(): string;
}
