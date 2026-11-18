<?php

declare(strict_types=1);

namespace DotTest\Authentication;

use Dot\Authentication\AuthenticationResult;
use DotTest\Authentication\Fixture\IdentityFixture;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class AuthenticationResultTest extends TestCase
{
    public function testConstructorStoresAllValues(): void
    {
        $identity = new IdentityFixture();
        $result   = new AuthenticationResult(AuthenticationResult::SUCCESS, 'valid', $identity);

        $this->assertSame(AuthenticationResult::SUCCESS, $result->getCode());
        $this->assertSame('valid', $result->getMessage());
        $this->assertSame($identity, $result->getIdentity());
        $this->assertTrue($result->hasIdentity());
    }

    public function testConstructorDefaults(): void
    {
        $result = new AuthenticationResult(AuthenticationResult::FAILURE);

        $this->assertSame('', $result->getMessage());
        $this->assertNull($result->getIdentity());
        $this->assertFalse($result->hasIdentity());
    }

    /**
     * @return iterable<string, array{int, bool}>
     */
    public static function codeProvider(): iterable
    {
        yield 'success' => [AuthenticationResult::SUCCESS, true];
        yield 'failure' => [AuthenticationResult::FAILURE, false];
        yield 'invalid credentials' => [AuthenticationResult::FAILURE_INVALID_CREDENTIALS, false];
        yield 'identity ambiguous' => [AuthenticationResult::FAILURE_IDENTITY_AMBIGUOUS, false];
        yield 'identity not found' => [AuthenticationResult::FAILURE_IDENTITY_NOT_FOUND, false];
        yield 'uncategorized' => [AuthenticationResult::FAILURE_UNCATEGORIZED, false];
        yield 'missing credentials' => [AuthenticationResult::FAILURE_MISSING_CREDENTIALS, false];
        yield 'custom positive code' => [2, true];
    }

    #[DataProvider('codeProvider')]
    public function testIsValidDependsOnCode(int $code, bool $expected): void
    {
        $this->assertSame($expected, (new AuthenticationResult($code))->isValid());
    }

    public function testSettersReplaceValues(): void
    {
        $identity = new IdentityFixture(20, 'other');
        $result   = new AuthenticationResult(AuthenticationResult::FAILURE);

        $result->setCode(AuthenticationResult::SUCCESS);
        $result->setMessage('changed');
        $result->setIdentity($identity);

        $this->assertSame(AuthenticationResult::SUCCESS, $result->getCode());
        $this->assertSame('changed', $result->getMessage());
        $this->assertSame($identity, $result->getIdentity());
        $this->assertTrue($result->isValid());
    }

    public function testSetIdentityAcceptsNullToClearIdentity(): void
    {
        $result = new AuthenticationResult(AuthenticationResult::SUCCESS, '', new IdentityFixture());

        $result->setIdentity(null);

        $this->assertNull($result->getIdentity());
        $this->assertFalse($result->hasIdentity());
    }
}
