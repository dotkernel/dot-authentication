<?php

declare(strict_types=1);

namespace DotTest\Authentication;

use Dot\Authentication\AuthenticationInterface;
use Dot\Authentication\Identity\IdentityInterface;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\TestCase;

class AuthenticationInterfaceTest extends TestCase
{
    protected AuthenticationInterface|Stub $mockAuthenticationInterface;

    protected IdentityInterface|Stub $identityInterfaceMock;

    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        $this->mockAuthenticationInterface = $this->createStub(AuthenticationInterface::class);
        $this->identityInterfaceMock       = $this->createStub(IdentityInterface::class);
        $this->identityInterfaceMock->method('getId')->willReturn(10);
        $this->identityInterfaceMock->method('getName')->willReturn('username');
        $this->mockAuthenticationInterface->method('hasIdentity')->willReturn(true);
        $this->mockAuthenticationInterface->method('getIdentity')->willReturn($this->identityInterfaceMock);
    }

    public function testCreate(): void
    {
        $this->assertInstanceOf(AuthenticationInterface::class, $this->mockAuthenticationInterface);
        $this->assertInstanceOf(IdentityInterface::class, $this->identityInterfaceMock);
    }

    public function testFunction(): void
    {
        $this->assertTrue($this->mockAuthenticationInterface->hasIdentity());
        $this->assertSame('username', $this->mockAuthenticationInterface->getIdentity()->getName());
        $this->assertSame(10, $this->mockAuthenticationInterface->getIdentity()->getId());
    }
}
