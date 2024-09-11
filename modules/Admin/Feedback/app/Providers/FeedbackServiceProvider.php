<?php

namespace Modules\Admin\Feedback\app\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class FeedbackServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../Resources', 'AdminFeedback');
        Paginator::defaultView('sections.pagination');
    }

}
