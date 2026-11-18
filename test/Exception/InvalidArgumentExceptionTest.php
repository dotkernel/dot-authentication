<?php

declare(strict_types=1);

namespace DotTest\Authentication\Exception;

use Dot\Authentication\Exception\ExceptionInterface;
use Dot\Authentication\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class InvalidArgumentExceptionTest extends TestCase
{
    public function testCanBeCaughtAsPackageException(): void
    {
        $this->expectException(ExceptionInterface::class);
        $this->expectExceptionMessage('message');

        throw new InvalidArgumentException('message');
    }

    public function testCanBeCaughtAsSplException(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        throw new InvalidArgumentException('message');
    }
}
