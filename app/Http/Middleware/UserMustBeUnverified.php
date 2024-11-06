<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;

class UserMustBeUnverified
{
    /**
     * User must be unverified if not redirect to the home page
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if ($request->user() instanceof MustVerifyEmail && $request->user()->hasVerifiedEmail()) {
            return redirect()->route('/');
        }

        return $next($request);
    }
}
