<?php

namespace Dasundev\NovaAccessSecret\Middlewares;

use Closure;
use Dasundev\NovaAccessSecret\AccessSecretCookie;
use Illuminate\Http\Request;

class VerifyAdminAccessSecret
{
    /**
     * Handle the incoming request.
     *
     * @return mixed|void
     */
    public function handle(Request $request, Closure $next)
    {
        $secret = config('nova-access-secret.key');

        $cookie = $request->cookie('nova_access_secret');

        if ($cookie && AccessSecretCookie::isValid($cookie, $secret) || blank($secret)) {
            return $next($request);
        }

        abort(404);
    }
}