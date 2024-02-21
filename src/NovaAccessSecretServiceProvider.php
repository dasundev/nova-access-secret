<?php

namespace Dasundev\NovaAccessSecret;

use Dasundev\NovaAccessSecret\Contracts\AccessSecretCookie;
use Dasundev\NovaAccessSecret\Controllers\StoreSecret;
use Dasundev\NovaAccessSecret\Exceptions\InvalidAccessSecretCookieException;
use Dasundev\NovaAccessSecret\Middlewares\VerifyAdminAccessSecret;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class NovaAccessSecretServiceProvider extends PackageServiceProvider
{
    /**
     * Configure the package.
     */
    public function configurePackage(Package $package): void
    {
        $package
            ->name('nova-access-secret')
            ->hasConfigFile();
    }

    /**
     * Booting the package.
     */
    public function bootingPackage(): void
    {
        $this->registerSingleton();

        $this->registerMiddleware();

        if (! $this->app->runningInConsole()) {
            $this->registerRoute();
        }
    }

    /**
     * Register the route.
     */
    private function registerRoute(): void
    {
        $novaPath = config('nova.path');

        $secretKey = config('nova-access-secret.key');

        Route::get("$novaPath/$secretKey", StoreSecret::class);
    }

    /**
     * Register the singleton.
     */
    public function registerSingleton(): void
    {
        $this->app->singleton('nova-access-secret', function () {
            $cookie = config('nova-access-secret.cookie');

            if (! class_exists($cookie) || ! class_implements($cookie, AccessSecretCookie::class)) {
                throw new InvalidAccessSecretCookieException;
            }

            return new $cookie;
        });
    }

    /**
     * Register the middleware.
     */
    private function registerMiddleware(): void
    {
        Config::prepend('nova.middleware', VerifyAdminAccessSecret::class);
    }
}
