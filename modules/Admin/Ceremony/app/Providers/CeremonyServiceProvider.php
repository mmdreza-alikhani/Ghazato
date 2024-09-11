<?php

namespace Modules\Admin\Ceremony\app\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class CeremonyServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../Resources', 'AdminCeremony');
        Paginator::defaultView('sections.pagination');
    }

}
