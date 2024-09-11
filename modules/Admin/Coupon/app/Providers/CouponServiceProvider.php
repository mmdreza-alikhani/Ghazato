<?php

namespace Modules\Admin\Coupon\app\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class CouponServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../Resources', 'AdminCoupon');
        Paginator::defaultView('sections.pagination');
    }

}
