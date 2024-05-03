<?php

declare(strict_types=1);

namespace DotTest\Authentication\Identity;

use Dot\Authentication\Identity\IdentityInterface;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class IdentityInterfaceTest extends TestCase
{
    protected IdentityInterface|MockObject $identityInterfaceMock;

    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        $this->identityInterfaceMock = $this->createMock(IdentityInterface::class);
        $this->identityInterfaceMock->method('getId')->will($this->returnValue(10));
        $this->identityInterfaceMock->method('getName')->willReturn('username');
    }

    public function testCreate(): void
    {
        $this->assertInstanceOf(IdentityInterface::class, $this->identityInterfaceMock);
    }

    public function testFunction(): void
    {
        $this->assertSame('username', $this->identityInterfaceMock->getName());
        $this->assertSame(10, $this->identityInterfaceMock->getId());
    }
}
