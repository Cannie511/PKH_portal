<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Bican\Roles\Exceptions\RoleDeniedException;

class VerifyMultiRole
{
    /**
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param \Illuminate\Contracts\Auth\Guard $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param int|string $role
     * @return mixed
     * @throws \Bican\Roles\Exceptions\RoleDeniedException
     */
    public function handle(
        $request,
        Closure $next,
        $roles
    ) {
        $arrRole = explode('|', $roles);

        if ($this->auth->check()) {

            foreach ($arrRole as $role) {

                if ($this->auth->user()->is($role)) {
                    return $next($request);
                }

            }

        }

        throw new RoleDeniedException($roles);
    }

}
