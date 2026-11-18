# Usage

## AuthenticationInterface

Each authentication service that works with Dotkernel applications must implement this interface.
The Dotkernel packages that use the authentication service type-hint against this interface.

Register the concrete implementation in the dependency container with the fully qualified name of this interface.

### Methods

```php
public function authenticate(ServerRequestInterface $request): AuthenticationResult;
```

This method does the authentication.

It gets the credentials from the `$request` object, for example from the `Authorization` header or from request attributes.
It returns an `AuthenticationResult` object, which contains the authentication status and, on success, the identity.

```php
public function challenge(ServerRequestInterface $request): ResponseInterface;
```

This method returns a PSR-7 `ResponseInterface` that tells the client or browser to authenticate first.
Usually, this response has a `WWW-Authenticate` header, which HTTP basic and digest authentication use.

```php
public function hasIdentity(): bool;
public function getIdentity(): ?IdentityInterface;
public function setIdentity(IdentityInterface $identity): void;
public function clearIdentity(): void;
```

Use these methods to:

- check if there is an authenticated identity
- get the authenticated identity
- set an identity directly, for example for auto-login
- clear the identity, for example at logout

## IdentityInterface

An authenticated identity (user) can be any object that implements this interface.
The interface has two methods:

- `getId(): mixed` returns the unique identifier of the identity.
- `getName(): string` returns a text that shows the identity, usually the email address or the username.

## AuthenticationResult

The authentication service returns this object on success and on failure.
It contains:

- one of the authentication codes, which gives the authentication status
- an error message if the authentication failed
- the identity object on success

The codes are `int` constants:

| Constant | Value |
| --- | --- |
| `AuthenticationResult::SUCCESS` | `1` |
| `AuthenticationResult::FAILURE` | `0` |
| `AuthenticationResult::FAILURE_INVALID_CREDENTIALS` | `-1` |
| `AuthenticationResult::FAILURE_IDENTITY_AMBIGUOUS` | `-2` |
| `AuthenticationResult::FAILURE_IDENTITY_NOT_FOUND` | `-3` |
| `AuthenticationResult::FAILURE_UNCATEGORIZED` | `-4` |
| `AuthenticationResult::FAILURE_MISSING_CREDENTIALS` | `-5` |

`isValid()` returns `true` when the code is greater than `0`.
Use `SUCCESS` for a successful authentication.
A custom code that is greater than `0` also counts as a success.

To remove the identity from a result, call `setIdentity(null)`.
After this call, `hasIdentity()` returns `false`.

## Exceptions

All exceptions in this package implement `Dot\Authentication\Exception\ExceptionInterface`.
This interface extends `Throwable`, so you can catch all exceptions of this package with one `catch` block:

```php
use Dot\Authentication\Exception\ExceptionInterface;

try {
    $result = $authentication->authenticate($request);
} catch (ExceptionInterface $exception) {
    $message = $exception->getMessage();
}
```

## UnauthorizedException

Throw this exception when a user tries to access content that needs authentication first.
An application can use it to start a custom action, for example a redirect to a login page.
There is no predefined handler for it.
Dotkernel packages use this exception together with a custom error handler.
In the Dotkernel Frontend and Admin applications, the authentication and authorization packages already do this.
When you throw an `UnauthorizedException` in these applications, the user goes to the login page by default.

The default exception code is `401`.
The third argument, `$previous`, accepts any `Throwable`, including an `Error`:

```php
use Dot\Authentication\Exception\UnauthorizedException;

throw new UnauthorizedException('You must log in first.', 401, $previous);
```
