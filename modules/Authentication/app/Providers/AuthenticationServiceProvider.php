<?php

namespace Modules\Authentication\app\Providers;

use Illuminate\Support\ServiceProvider;

class AuthenticationServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../Resources', 'Authentication');
    }

}
