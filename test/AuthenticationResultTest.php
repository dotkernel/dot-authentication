<?php
/**
 * @copyright: DotKernel
 * @library: dotkernel/dot-authentication
 * @author: n3vrax
 * Date: 4/14/2016
 * Time: 11:19 PM
 */

namespace DotKernelTest\DotAuthentication;

use DotKernel\DotAuthentication\AuthenticationResult;
use DotKernel\DotAuthentication\Identity\IdentityInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class AuthenticationResultTest
 * @package DotKernelTest\DotAuthentication
 */
class AuthenticationResultTest extends \PHPUnit_Framework_TestCase
{
    public function testGetters()
    {
        $request = $this->prophesize(ServerRequestInterface::class)->reveal();
        $response = $this->prophesize(ResponseInterface::class)->reveal();
        $identity = $this->prophesize(IdentityInterface::class)->reveal();

        $result = new AuthenticationResult(
            AuthenticationResult::SUCCESS,
            $request,
            $response,
            $identity,
            ['foo']
        );

        $this->assertEquals(AuthenticationResult::SUCCESS, $result->getCode());
        $this->assertEquals($request, $result->getRequest());
        $this->assertEquals($response, $result->getResponse());
        $this->assertEquals($identity, $result->getIdentity());
        $this->assertTrue($result->isValid());

        $result = new AuthenticationResult(
            AuthenticationResult::FAILURE,
            $request,
            $response
        );

        $this->assertNull($result->getIdentity());
        $this->assertFalse($result->isValid());
    }
}