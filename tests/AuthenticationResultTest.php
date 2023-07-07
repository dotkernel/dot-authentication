<?php

declare(strict_types=1);

namespace DotTest\Authentication;

use Dot\Authentication\AuthenticationResult;
use Dot\Authentication\Identity\IdentityInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class AuthenticationResultTest extends TestCase
{
    protected AuthenticationResult $subject;
    protected MockObject|IdentityInterface $indentyInterfaceMock;

    protected function setUp(): void
    {
        $this->indentyInterfaceMock = $this->createMock(IdentityInterface::class);
        $this->indentyInterfaceMock->method('getId')->will($this->returnValue(10));
        $this->indentyInterfaceMock->method('getName')->willReturn('username');
        $this->subject = new AuthenticationResult(1, 'valid', $this->indentyInterfaceMock);

        parent::setUp();
    }

    public function testAuth()
    {
        $code      = $this->subject->getCode();
        $message   = $this->subject->getMessage();
        $name      = $this->subject->getIdentity();
        $interface = $this->subject->hasIdentity();
        $isValid   = $this->subject->isValid();

        $this->assertSame(1, $code);
        $this->assertSame('valid', $message);
        $this->assertSame('username', $name->getName());
        $this->assertSame(10, $name->getId());
        $this->assertTrue($interface);
        $this->assertEquals('valid', $message);
        $this->assertTrue($isValid);
    }
}
