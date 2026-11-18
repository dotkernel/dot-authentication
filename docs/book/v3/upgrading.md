# Upgrading from 2.x

Version 3.0 has changes that can break code which extends or implements classes of this package.
Code that only calls the package methods does not need changes.

The 2.x line gets only security fixes.

## Requirements

Version 3.0 needs PHP 8.3 or later.
PHP 8.2 is not supported.

## Changes that can break code

| Change | Symptom | Fix |
| --- | --- | --- |
| PHP 8.2 is not supported | Composer does not install 3.x on PHP 8.2 | Use PHP 8.3 or later |
| `ExceptionInterface` extends `Throwable` | `Class X cannot implement interface Throwable, extend Exception or Error instead` | Make the class extend `Exception` or `Error` |
| `AuthenticationResult::setIdentity()` accepts `null` | `Declaration of X::setIdentity(...) must be compatible with ...` in a subclass | Change the parameter of the subclass method to `?IdentityInterface` |
| The `AuthenticationResult` constants have the type `int` | `Type of X::SUCCESS must be compatible with ... of type int` in a subclass | Declare the constant as `public const int` |

## Changes that do not break code

- `UnauthorizedException::__construct()` accepts any `Throwable` as `$previous`, not only an `Exception`.
  A subclass constructor can keep its signature.

## Examples

### A subclass of AuthenticationResult

Before:

```php
use Dot\Authentication\AuthenticationResult;
use Dot\Authentication\Identity\IdentityInterface;

class MyResult extends AuthenticationResult
{
    public const FAILURE_ACCOUNT_LOCKED = -10;

    public function setIdentity(IdentityInterface $identity): void
    {
        parent::setIdentity($identity);
    }
}
```

After:

```php
use Dot\Authentication\AuthenticationResult;
use Dot\Authentication\Identity\IdentityInterface;

class MyResult extends AuthenticationResult
{
    public const int FAILURE_ACCOUNT_LOCKED = -10;

    public function setIdentity(?IdentityInterface $identity): void
    {
        parent::setIdentity($identity);
    }
}
```

A new constant in a subclass does not need a type.
Add the type to keep the constants consistent.

### A class that implements ExceptionInterface

Before:

```php
use Dot\Authentication\Exception\ExceptionInterface;

class MyException implements ExceptionInterface
{
}
```

After:

```php
use Dot\Authentication\Exception\ExceptionInterface;
use RuntimeException;

class MyException extends RuntimeException implements ExceptionInterface
{
}
```
