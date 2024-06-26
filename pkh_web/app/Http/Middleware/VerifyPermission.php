<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use JWTAuth;
use Illuminate\Contracts\Auth\Guard;
use Bican\Roles\Exceptions\PermissionDeniedException;

class VerifyPermission
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
     * @param int|string $permission
     * @return mixed
     * @throws \Bican\Roles\Exceptions\PermissionDeniedException
     */
    public function handle(
        $request,
        Closure $next,
        $permission
    ) {
        $user = $this->auth->user();

        if (empty($user)) {
            $user = JWTAuth::toUser();
        }

        if (!empty($user) && $user->can($permission)) {
            return $next($request);
        }

        // throw new PermissionDeniedException($permission);
        abort(403, (new PermissionDeniedException($permission))->getMessage());
    }

}
