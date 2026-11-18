<?php

declare(strict_types=1);

namespace DotTest\Authentication\Fixture;

use Dot\Authentication\Identity\IdentityInterface;

final class IdentityFixture implements IdentityInterface
{
    public function __construct(
        private readonly mixed $id = 10,
        private readonly string $name = 'username',
    ) {
    }

    public function getId(): mixed
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
