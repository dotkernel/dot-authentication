<?php

declare(strict_types=1);

namespace DotTest\Authentication\Exception;

use Dot\Authentication\Exception\RuntimeException;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class RuntimeExceptionTest extends TestCase
{
    protected RuntimeException|MockObject $exceptionInterfaceMock;

    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        $this->exceptionInterfaceMock = $this->createMock(RuntimeException::class);
    }

    public function testCreate(): void
    {
        $this->assertInstanceOf(RuntimeException::class, $this->exceptionInterfaceMock);
    }
}
