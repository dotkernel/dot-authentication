<?php

declare(strict_types=1);

namespace DotTest\Authentication\Exception;

use InvalidArgumentException;
use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\TestCase;

class InvalidArgumentExceptionTest extends TestCase
{
    protected InvalidArgumentException|Stub $exceptionInterfaceMock;

    public function setUp(): void
    {
        $this->exceptionInterfaceMock = $this->createStub(InvalidArgumentException::class);
    }

    public function testCreate(): void
    {
        $this->assertInstanceOf(InvalidArgumentException::class, $this->exceptionInterfaceMock);
    }
}
