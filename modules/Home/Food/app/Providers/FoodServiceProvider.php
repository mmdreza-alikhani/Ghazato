<?php

namespace Modules\Home\Food\app\Providers;

use Illuminate\Support\ServiceProvider;

class FoodServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../Resources', 'Food');
    }

}
