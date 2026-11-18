<?php

declare(strict_types=1);

namespace DotTest\Authentication\Exception;

use Dot\Authentication\Exception\ExceptionInterface;
use Dot\Authentication\Exception\UnauthorizedException;
use PHPUnit\Framework\TestCase;
use TypeError;

final class UnauthorizedExceptionTest extends TestCase
{
    public function testDefaultCodeIs401(): void
    {
        $exception = new UnauthorizedException();

        $this->assertSame(401, $exception->getCode());
        $this->assertSame('', $exception->getMessage());
    }

    public function testCanBeCaughtAsPackageException(): void
    {
        $this->expectException(ExceptionInterface::class);
        $this->expectExceptionCode(401);

        throw new UnauthorizedException();
    }

    public function testAcceptsAnyThrowableAsPrevious(): void
    {
        $previous  = new TypeError('inner');
        $exception = new UnauthorizedException('Login required', 403, $previous);

        $this->assertSame('Login required', $exception->getMessage());
        $this->assertSame(403, $exception->getCode());
        $this->assertSame($previous, $exception->getPrevious());
    }
}
