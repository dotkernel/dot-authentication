<?php

declare(strict_types=1);

namespace DotTest\Authentication\Exception;

use Dot\Authentication\Exception\RuntimeException;
use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\TestCase;

class RuntimeExceptionTest extends TestCase
{
    protected RuntimeException|Stub $exceptionInterfaceMock;

    public function setUp(): void
    {
        $this->exceptionInterfaceMock = $this->createStub(RuntimeException::class);
    }

    public function testCreate(): void
    {
        $this->assertInstanceOf(RuntimeException::class, $this->exceptionInterfaceMock);
    }
}
