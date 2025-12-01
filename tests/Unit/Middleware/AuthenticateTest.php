<?php

namespace Tests\Unit\Middleware;

use App\Http\Middleware\Authenticate;
use Illuminate\Http\Request;
use Tests\TestCase;

class AuthenticateTest extends TestCase
{
    /** @test */
    public function it_redirects_to_login_when_request_is_not_json()
    {
        $middleware = new Authenticate(app('auth'));
        $request = Request::create('/any', 'GET');

        $result = $this->invokeMethod($middleware, 'redirectTo', [$request]);

        $this->assertEquals(route('login'), $result);
    }

    /** @test */
    public function it_returns_null_when_request_expects_json()
    {
        $middleware = new Authenticate(app('auth'));
        
        $request = Request::create('/any', 'GET', [], [], [], [
            'HTTP_ACCEPT' => 'application/json',
        ]);

        $result = $this->invokeMethod($middleware, 'redirectTo', [$request]);

        $this->assertNull($result);
    }

    /**
     * Helper to call protected/private methods.
     */
    protected function invokeMethod($object, $methodName, array $parameters = [])
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
