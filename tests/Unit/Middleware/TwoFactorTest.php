<?php

declare(strict_types=1);

namespace Tests\Unit\Middleware;

use App\Http\Middleware\TwoFactor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Mockery;
use Tests\TestCase;

class TwoFactorTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Fake routes for redirect()
        Route::name('login')->get('/login', fn () => 'login');
        Route::name('verify.index')->get('/verify', fn () => 'verify');
    }

    /** @test */
    public function it_allows_request_when_two_factor_is_disabled()
    {
        Config::set('app.two_factor', false);

        $middleware = new TwoFactor();
        $request    = Request::create('/dashboard', 'GET');

        $next = fn () => 'OK';

        $result = $middleware->handle($request, $next);

        $this->assertEquals('OK', $result);
    }

    /** @test */
    public function it_allows_request_when_user_is_not_authenticated()
    {
        Config::set('app.two_factor', true);

        Auth::shouldReceive('check')->andReturn(false);
        Auth::shouldReceive('user')->andReturn(null);   // ← ADD THIS

        $middleware = new TwoFactor();
        $request    = Request::create('/dashboard', 'GET');

        $next = fn () => 'OK';

        $result = $middleware->handle($request, $next);

        $this->assertEquals('OK', $result);
    }

    /** @test */
    public function it_allows_request_when_2fa_not_enabled_for_user()
    {
        Config::set('app.two_factor', true);

        $user                  = Mockery::mock(User::class)->makePartial();
        $user->two_factor      = false;
        $user->two_factor_code = null;

        Auth::shouldReceive('check')->andReturn(true);
        Auth::shouldReceive('user')->andReturn($user);

        $middleware = new TwoFactor();
        $request    = Request::create('/dashboard', 'GET');

        $next = fn () => 'OK';

        $this->assertEquals('OK', $middleware->handle($request, $next));
    }

    /** @test */
    public function it_redirects_when_two_factor_code_is_expired()
    {
        Config::set('app.two_factor', true);

        $user                        = Mockery::mock(User::class)->makePartial();
        $user->two_factor            = true;
        $user->two_factor_code       = '1234';
        $user->two_factor_expires_at = now()->subMinutes(1);

        $user->shouldReceive('resetTwoFactorCode')->once();

        Auth::shouldReceive('check')->andReturn(true);
        Auth::shouldReceive('user')->andReturn($user);
        Auth::shouldReceive('logout')->once();

        $middleware = new TwoFactor();
        $request    = Request::create('/dashboard', 'GET');

        $response = $middleware->handle($request, fn () => null);

        $this->assertTrue($response->isRedirect(route('login')));
        $this->assertEquals('info', session('status'));
    }

    /** @test */
    public function it_redirects_to_verify_when_code_valid_but_not_on_verify_route()
    {
        Config::set('app.two_factor', true);

        $user                        = Mockery::mock(User::class)->makePartial();
        $user->two_factor            = true;
        $user->two_factor_code       = '1234';
        $user->two_factor_expires_at = now()->addMinutes(5);

        Auth::shouldReceive('check')->andReturn(true);
        Auth::shouldReceive('user')->andReturn($user);

        $middleware = new TwoFactor();
        $request    = Request::create('/dashboard', 'GET');

        $response = $middleware->handle($request, fn () => null);

        $this->assertTrue($response->isRedirect(route('verify.index')));
    }

    /** @test */
    public function it_allows_request_when_on_verify_route()
    {
        Config::set('app.two_factor', true);

        $user                        = Mockery::mock(User::class)->makePartial();
        $user->two_factor            = true;
        $user->two_factor_code       = '1234';
        $user->two_factor_expires_at = now()->addMinutes(5);

        Auth::shouldReceive('check')->andReturn(true);
        Auth::shouldReceive('user')->andReturn($user);

        $middleware = new TwoFactor();
        $request    = Request::create('/verify', 'GET');

        $next = fn () => 'OK';

        $result = $middleware->handle($request, $next);

        $this->assertEquals('OK', $result);
    }
}
