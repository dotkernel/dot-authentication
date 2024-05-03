<?php

declare(strict_types=1);

namespace DotTest\Authentication\Exception;

use InvalidArgumentException;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class InvalidArgumentExceptionTest extends TestCase
{
    protected InvalidArgumentException|MockObject $exceptionInterfaceMock;

    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        $this->exceptionInterfaceMock = $this->createMock(InvalidArgumentException::class);
    }

    public function testCreate(): void
    {
        $this->assertInstanceOf(InvalidArgumentException::class, $this->exceptionInterfaceMock);
    }
}
