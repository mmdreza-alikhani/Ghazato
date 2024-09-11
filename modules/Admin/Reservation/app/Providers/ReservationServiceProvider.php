<?php

namespace Modules\Admin\Reservation\app\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class ReservationServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../Resources', 'AdminReservation');
        Paginator::defaultView('sections.pagination');
    }

}
