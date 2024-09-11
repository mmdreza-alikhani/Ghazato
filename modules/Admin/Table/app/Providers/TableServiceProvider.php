<?php

namespace Modules\Admin\Table\app\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class TableServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../Resources', 'AdminTable');
        Paginator::defaultView('sections.pagination');
    }

}
