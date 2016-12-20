# dot-authentication

Package defining authentication abstractions for authentication services.
This package is common between several other dotkernel packages which work with authentication.

## Installation

Usually this package will be installed with a concrete implementation of the authentication interface so you don't have to add it directly to a project.
We provide a concrete implementation built around [zend-authentication](https://github.com/zendframework/zend-authentication) which you can find at [dot-authentication-service](https://github.com/dotkernel/dot-authentication-service)

You can also implement your own authentication service by implementing the `AuthenticationInterface` in which case you'll need to add this package as dependency in your composer.json file by running the following command
```bash
$ composer require dotkernel/dot-authentication
```

## AuthenticationInterface

Interface that need to be implemented for an authentication service. 
It is psr7 oriented, so parameters to authentication services are just valid psr7 requests and responses. 
The actual authentication implementation must be able to extract credentials from the request(headers, attributes etc.) . 
This is left to the choice of the implementor.

### Methods

##### challenge

```php
public function challenge(ServerRequestInterface $request, ResponseInterface $response);
```

You must implement this method, and return a valid response specific to the authentication adapters that should be sent to clients in order to tell them they need to authenticate and how. 
Its purpose is to make possible to return an authentication adapter specific response(some require certain headers) but still keep the module decoupled from implementation details. 
It receives the psr7 request and response. It is recommended to return a modified version of the passed response.

Example: for HTTP authentications, should be a 401 response with a WWW-Authenticate header You could also return a falsy result in case adapter is not able to create a response, or it does not needs. 
This case must be caught in the projects that use the authentication interface and managed based on the project needs.

##### authenticate

```php
public function authenticate(ServerRequestInterface $request, ResponseInterface $response);
```

Authenticate the request, by extracting credentials from it, if present, and return an `AuthenticationResult` object.
An `AuthenticationResult` object compose an identity object(if authentication succeeded), a flag indicating the authentication validity and also the original or modified request and response object, depending on the authentication needs.
This method could also return a boolean false value, indicating the request cannot be authenticated usually because credentials are missing completely from the request, so that the authentication is skipped. This works well when there is an authentication middleware with high priority that checks request, but can also skip authentication in case the application accepts guests.

##### hasIdentity
```php
public function hasIdentity();
```
Checks if someone is currently authenticated, returning a boolean value

##### getIdentity
```php
public function getIdentity();
```
Gets the currently authenticated identity object. You should call `hasIdentity` before calling this method.

##### clearIdentity
```php
public function clearIdentity();
```
Clears the current identity from where it is stored, basically logging out the user

##### setIdentity
```php
public function setIdentity(IdentityInterface $identity);
```
Forcefully set an identity, useful for auto-logins.

## IdentityInterface

Defines the interface that must be implemented by objects defining authenticated entities. Only 2 methods are required by this interface:

```php
public function getId();
```
Gets the authenticated identity identifier(ID) value

```php
public function getName();
```
Gets the name(usually uniquely) describing the authenticated identity.

## AuthenticationResult

Object that needs to be returned by the `authenticate` method which describes the authentication operation result.
Initializing an authentication result is made through its constructor, which has the following signature.

```php
public function __construct(
        $code,
        ServerRequestInterface $request,
        ResponseInterface $response,
        IdentityInterface $identity = null,
        $message = null)
```

`$code` should be one of the predefined constants

```php
AuthenticationResult::FAILURE
AuthenticationResult::SUCCESS
AuthenticationResult::FAILURE_INVALID_CREDENTIALS
AuthenticationResult::FAILURE_IDENTITY_AMBIGUOUS
AuthenticationResult::FAILURE_IDENTITY_NOT_FOUND
AuthenticationResult::FAILURE_UNCATEGORIZED
```

## Unauthorized errors

Can be triggered from a middleware by throwing an `UnauthorizedException` object. 
Error handling middleware should be provided by other packages to handle this kind of error in a specific manner.