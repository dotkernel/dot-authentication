<?php

declare(strict_types=1);

namespace DotTest\Authentication\Exception;

use Dot\Authentication\Exception\UnauthorizedException;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class UnauthorizedExceptionTest extends TestCase
{
    protected UnauthorizedException|MockObject $exceptionInterfaceMock;

    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        $this->exceptionInterfaceMock = $this->createMock(UnauthorizedException::class);
    }

    public function testCreate(): void
    {
        $this->assertInstanceOf(UnauthorizedException::class, $this->exceptionInterfaceMock);
    }
}
