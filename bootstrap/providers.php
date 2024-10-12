<?php

return [
    App\Providers\AppServiceProvider::class,
    Modules\Authentication\app\Providers\AuthenticationServiceProvider::class,
    Modules\Admin\Main\app\Providers\MainServiceProvider::class,
    Modules\Admin\Category\app\Providers\CategoryServiceProvider::class,
    Modules\Admin\Setting\app\Providers\SettingServiceProvider::class,
    Modules\Admin\Ingredient\app\Providers\IngredientServiceProvider::class,
    Modules\Admin\Comment\app\Providers\CommentServiceProvider::class,
    Modules\Admin\Feedback\app\Providers\FeedbackServiceProvider::class,
    Modules\Admin\Food\app\Providers\FoodServiceProvider::class,
    Modules\Admin\Order\app\Providers\OrderServiceProvider::class,
    Modules\Admin\Shop\app\Providers\ShopServiceProvider::class,
    Modules\Admin\Ceremony\app\Providers\CeremonyServiceProvider::class,
    Modules\Admin\Table\app\Providers\TableServiceProvider::class,
    Modules\Admin\Reservation\app\Providers\ReservationServiceProvider::class,
    Modules\Admin\Banner\app\Providers\BannerServiceProvider::class,
    Modules\Admin\User\app\Providers\UserServiceProvider::class,
    Modules\Admin\Coupon\app\Providers\CouponServiceProvider::class,
    Modules\Home\Main\app\Providers\MainServiceProvider::class,
    Modules\Home\Cart\app\Providers\CartServiceProvider::class,
    Modules\Home\Profile\app\Providers\ProfileServiceProvider::class,
    Modules\Home\Shop\app\Providers\ShopServiceProvider::class,
    Modules\Home\Reservation\app\Providers\ReservationServiceProvider::class,
    Modules\Home\Food\app\Providers\FoodServiceProvider::class,
];
