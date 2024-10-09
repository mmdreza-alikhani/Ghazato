<?php

namespace Modules\Home\Profile\app\Providers;

use Illuminate\Support\ServiceProvider;

class ProfileServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../Resources', 'Profile');
    }

}
