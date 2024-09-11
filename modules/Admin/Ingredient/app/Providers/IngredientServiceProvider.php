<?php

namespace Modules\Admin\Ingredient\app\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class IngredientServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../Resources', 'AdminIngredient');
        Paginator::defaultView('sections.pagination');
    }

}
