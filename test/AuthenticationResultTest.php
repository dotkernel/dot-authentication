<?php
/**
 * @copyright: DotKernel
 * @library: dotkernel/dot-authentication
 * @author: n3vrax
 * Date: 9/6/2016
 * Time: 7:49 PM
 */

namespace DotTest\Authentication;

use Dot\Authentication\AuthenticationResult;
use Dot\Authentication\Identity\IdentityInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class AuthenticationResultTest
 * @package DotTest\Authentication
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