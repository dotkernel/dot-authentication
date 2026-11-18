<?php

declare(strict_types=1);

namespace DotTest\Authentication\Exception;

use Dot\Authentication\Exception\ExceptionInterface;
use Dot\Authentication\Exception\RuntimeException;
use PHPUnit\Framework\TestCase;

final class RuntimeExceptionTest extends TestCase
{
    public function testCanBeCaughtAsPackageException(): void
    {
        $this->expectException(ExceptionInterface::class);
        $this->expectExceptionMessage('message');

        throw new RuntimeException('message');
    }

    public function testCanBeCaughtAsSplException(): void
    {
        $this->expectException(\RuntimeException::class);

        throw new RuntimeException('message');
    }
}
