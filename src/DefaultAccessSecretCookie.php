<?php

namespace Dasundev\NovaAccessSecret;

use Dasundev\NovaAccessSecret\Contracts\AccessSecretCookie;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Cookie;

class DefaultAccessSecretCookie implements AccessSecretCookie
{
    /**
     * Create a new access secret cookie.
     */
    public static function create(string $key): Cookie
    {
        $expiresAt = Carbon::now()->addHours(12);

        return new Cookie('nova_access_secret', base64_encode(json_encode([
            'expires_at' => $expiresAt->getTimestamp(),
            'mac' => hash_hmac('sha256', $expiresAt->getTimestamp(), $key),
        ])), $expiresAt, config('session.path'), config('session.domain'));
    }

    /**
     * Determine if the given access secret is valid.
     */
    public static function isValid(string $cookie, string $key): bool
    {
        $payload = json_decode(base64_decode($cookie), true);

        return is_array($payload) &&
            is_numeric($payload['expires_at'] ?? null) &&
            isset($payload['mac']) &&
            hash_equals(hash_hmac('sha256', $payload['expires_at'], $key), $payload['mac']) &&
            (int) $payload['expires_at'] >= Carbon::now()->getTimestamp();
    }
}