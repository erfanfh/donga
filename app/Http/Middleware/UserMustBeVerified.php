<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class UserMustBeVerified
{
    /**
     * User must be verified if not redirect to the verification page
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (! $request->user() || (! $request->user()->hasVerifiedEmail())) {
            return Redirect::guest(URL::route('verify'));
        }

        return $next($request);
    }
}
