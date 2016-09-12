# dot-authentication

This is a core package for dk apps built on top of zend-expressive. Following the way zend-expressive provides abstractions for its router, template etc., this package provides abstraction for an authentication service. 

### Instalation

Usually this package will be installed with a concrete implementation of the authentication interface so you dont have to add it directly to a project. We provide [dk-zend-auhentication](http://github.com/n3vrax/dk-zend-authentication) as a bridge with zend-authentication. If you want to write your own implementation, this is how you install it:

Add the package manually to your `composer.json` or run the following command from the project's root directory
```bash
$ composer require dotkernel/dot-authentication
```

Also make sure that your composer has the minimum stability set to dev for now.
```
"minimum-stability": "dev",
```

### AuthenticationInterface

Interface that need to be implemented for an authentication service. It is psr7 oriented, so parameters to authentication services are just valid psr7 requests and responses. The actual authentication implementation must be able to extract credentials from the request(headers, attributes etc.) . This is left to the choice of the implementor.

#### challenge
```php
public function challenge(ServerRequestInterface $request, ResponseInterface $response);
```
You must implement this method, and return a valid response specific to the authentication adapters that should be sent to clients in order to tell them they need to authenticate and how. Its purpose is to make possible to return an authentication adapter specific response(some require certain headers) but still keep the module decoupled from implementation details.
It receives the psr7 request and response. It is recommended to return a modified version of the passed response.

Example: for HTTP authentications, should be a `401` response with a `WWW-Authenticate` header
You could also return a falsy result in case adapter is not able to create a response, or it does not needs. This case must be caught in the projects that use the authentication interface and managed based on the project needs.

#### authenticate
```php
public function authenticate(ServerRequestInterface $request, ResponseInterface $response);
```

Given the request and response, should extract authentication credentials from the request, check if the provided credentials are valid and return a `AuthenticationResult`. Any modifications made to the request/response objects passed in should be provided to the AuthenticationResult along with the identity if authentication was successful. It can also return a falsy response, in case client cannot be authenticated and application accepts guest identity. For example, if Authorization header is not present, we should skip authentication and consider the missing identity as guest. By using this, we can create authentication logic that will work both for APIs and custom web form authentication.

#### Identity related methods

```php
    //check if we have an identity
    public function hasIdentity();
    //get the stored identity - recommended an IdentityInterface
    public function getIdentity();
    //clear identity - actually performing a logout
    public function clearIdentity();
    //forcefully sets the identity - useful for auto-login maybe
    public function setIdentity(IdentityInterface $identity);
```

As you can see, another functionality that the authentication service must provide, is storing the authenticated identity(non-persistent, session, db etc.) and be able to retreive it.

### AuthenticationResult

Initializing an authentication result through the constructor, which is pretty self-explanatory
```php
public function __construct(
        $code,
        ServerRequestInterface $request,
        ResponseInterface $response,
        IdentityInterface $identity = null,
        $message = null)
```

`code` should be one of the predefined constants in the class. 

The request/response object are also passed in, and should come from the authentication service, modified or not. Project using concrete implementations should consider this request/response object as the one that needs to be passed further down the pipeline.

### Unauthorized errors

Can be triggered from a middleware by throwing an UnauthorizedException object. Error handling middleware should be provided by other packages to handle this kind of error in a specific manner.

