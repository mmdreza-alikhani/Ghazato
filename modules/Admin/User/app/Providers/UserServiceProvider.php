<?php

namespace Modules\Admin\User\app\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../Resources', 'AdminUser');
        Paginator::defaultView('sections.pagination');
    }

}
