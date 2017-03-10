<?php
/**
 * @see https://github.com/dotkernel/dot-authentication/ for the canonical source repository
 * @copyright Copyright (c) 2017 Apidemia (https://www.apidemia.com)
 * @license https://github.com/dotkernel/dot-authentication/blob/master/LICENSE.md MIT License
 */

declare(strict_types = 1);

namespace Dot\Authentication\Identity;

/**
 * Interface IdentityInterface
 * @package Dot\Authentication\Identity
 */
interface IdentityInterface
{
    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return string
     */
    public function getName(): string;
}
