<?php

declare(strict_types=1);

namespace DotTest\Authentication\Exception;

use Dot\Authentication\Exception\UnauthorizedException;
use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\TestCase;

class UnauthorizedExceptionTest extends TestCase
{
    protected UnauthorizedException|Stub $exceptionInterfaceMock;

    public function setUp(): void
    {
        $this->exceptionInterfaceMock = $this->createStub(UnauthorizedException::class);
    }

    public function testCreate(): void
    {
        $this->assertInstanceOf(UnauthorizedException::class, $this->exceptionInterfaceMock);
    }
}
