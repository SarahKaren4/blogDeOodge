<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class CheckIfAdmin
{

    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admin')
    {
        if (!$this->auth->guard($guard)->check()) {
            return redirect()->route('admin.login');
        }

        $this->auth->shouldUse($guard);

        return $next($request);
    }

}
