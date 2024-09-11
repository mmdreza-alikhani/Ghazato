<?php

namespace Modules\Home\Reservation\app\Providers;

use Illuminate\Support\ServiceProvider;

class ReservationServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../Resources', 'Reservation');
    }

}
