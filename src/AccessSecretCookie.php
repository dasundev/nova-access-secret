<?php

namespace Dasundev\NovaAccessSecret;

use Illuminate\Support\Facades\Facade;

/**
 * @method static create(string $key): Cookie
 * @method isValid(string $cookie, string $key): bool
 */
class AccessSecretCookie extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'nova-access-secret';
    }
}