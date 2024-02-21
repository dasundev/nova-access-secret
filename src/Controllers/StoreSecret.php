<?php

namespace Dasundev\NovaAccessSecret\Controllers;

use Dasundev\NovaAccessSecret\AccessSecretCookie;
use Illuminate\Http\RedirectResponse;

class StoreSecret extends Controller
{
    /**
     * Store a cookie on the web browser.
     */
    public function __invoke(): RedirectResponse
    {
        $secret = config('nova-access-secret.key');

        return to_route('nova.pages.login')->withCookie(AccessSecretCookie::create($secret));
    }
}
