# Usage

## AuthenticationInterface

Defines the interface that should be implemented by any authentication service, in order to work with DotKernel applications. This is a result of the fact that the default packages used by DotKernel applications, that need access to the authentication service are type-hinted against this interface.

Also, concrete implementations should be registered in the service manager using this interface's FQN.

### Methods

```php
public function authenticate(ServerRequestInterface $request): AuthenticationResult;
```

* method to implement the actual authentication process. It should extract credentials from the `$request` object(Authorization header, custom request attributes etc.). It should return an `AuthenticationResult` object, defined in this package, which carry the authentication status and identity on success.

```php
public function challenge(ServerRequestInterface $request): ResponseInterface;
```

* this method should return a valid  PSR-7 `ResponseInterface` used to notify the client or browser that it needs to authenticate first(usually using the `WWW-Authenticate` header - usefull for HTTP basic and digest authentication)

```php
public function hasIdentity(): bool;
public function getIdentity(): ?IdentityInterface;
public function setIdentity(IdentityInterface $identity);
public function clearIdentity();
```

* these methods are used to check if authenticated, get the authenticated identity object, force set an identity(maybe useful for auto-login) or clear an identity(logout)

## IdentityInterface

You can use any object to represent an authenticated identity(user) as long as it implements this interface. It requires 2 methods, `getId()` which should return the unique identifier of the identity, and `getName(): string` which should return a string representation of the identity(for display purposes, usually the email or username)

## AuthenticationResult

Returned by the authentication service, on authentication success or failure. It composes one of the predefined authentication codes, which describes the authentication status, an error message in case the authentication has failed, and the identity object on success.

## UnauthorizedException

Exception to be thrown when accessing content that need authentication first. This can be used within an application to trigger an error and do a custom action(like redirecting to a login page). There is not a predefined way to handle this, DotKernel packages use this exception paired with a custom error handler to handle unauthorized errors. When using the frontend or admin applications, this is already setup among the authentication/authorization packages, and throwing an UnauthorizedException from anywhere your application, it will redirect to the login page by default.
