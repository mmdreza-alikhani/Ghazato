<?php

use App\Models\City;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\Admin\Banner\app\Http\Controllers\BannerController as AdminBannerController;
use Modules\Admin\Category\app\Http\Controllers\CategoryController as AdminCategoryController;
use Modules\Admin\Coupon\app\Http\Controllers\CouponController as AdminCouponController;
use Modules\Admin\Food\app\Http\Controllers\FoodController as AdminFoodController;
use Modules\Admin\Order\app\Http\Controllers\OrderController as AdminOrderController;
use Modules\Admin\Food\app\Http\Controllers\FoodImageController as AdminFoodImageController;
use Modules\Admin\Ingredient\app\Http\Controllers\IngredientController as AdminIngredientController;
use Modules\Admin\Comment\app\Http\Controllers\CommentController as AdminCommentController;
use Modules\Admin\Feedback\app\Http\Controllers\FeedbackController as AdminFeedbackController;
use Modules\Admin\Ceremony\app\Http\Controllers\CeremonyController as AdminCeremonyController;
use Modules\Admin\Table\app\Http\Controllers\TableController as AdminTableController;
use Modules\Admin\Reservation\app\Http\Controllers\ReservationController as AdminReservationController;
use Modules\Admin\Main\app\Http\Controllers\MainController as AdminMainController;
use Modules\Admin\Setting\app\Http\Controllers\SettingController as AdminSettingController;
use Modules\Admin\Shop\app\Http\Controllers\ShopController as AdminShopController;
use Modules\Admin\User\app\Http\Controllers\UserController as AdminUserController;
use Modules\Home\Cart\app\Http\Controllers\CartController;
use Modules\Home\Food\app\Http\Controllers\FoodController;
use Modules\Home\Main\app\Http\Controllers\MainController;
use Modules\Home\Profile\app\Http\Controllers\AddressController;
use Modules\Home\Profile\app\Http\Controllers\ProfileController;
use Modules\Home\Shop\app\Http\Controllers\ShopController;
use Modules\Home\Reservation\app\Http\Controllers\ReservationController;

// PUBLIC
    Route::get('get_province_cities_list', function (Request $request) {
        return City::where('province_id', $request->province_id)->get();
    });
    Route::get('get_available_shop_tables_list', function (Request $request) {
        $date = $request->date;
        return $freeTables = Table::where('shop_id', $request->shop_id)->whereDoesntHave('reservations', function ($query) use ($date) {
            $query->where('date', convertJalaliDateToGregorianDate($date));
        })->get();
    });
// END:PUBLIC

// HOME
Route::prefix('/')->name('home.')->group(function (){

    // MAIN
    Route::get('' , [MainController::class, 'index'])->name('index');
    // END: MAIN

    // FEEDBACKS
    Route::post('send-feedback' , [MainController::class, 'receiveFeedback'])->middleware('throttle:3,1')->name('receiveFeedback');
    // END: FEEDBACKS

    // SHOPS
    Route::prefix('shops/')->name('shops.')->group(function (){
        Route::prefix('{shop:slug}/reservation/')->name('reservation.')->group(function (){
            Route::get('', [ReservationController::class , 'index'])->name('index');
            Route::post('reserve', [ReservationController::class , 'reserve'])->name('reserve');
        });
        Route::get('', [ShopController::class , 'index'])->name('index');
        Route::get('{shop:slug}', [ShopController::class , 'show'])->name('show');
    });
    // END: SHOPS

    // FOODS
    Route::prefix('foods/')->name('foods.')->group(function (){
        Route::post('comment/{food}', [FoodController::class , 'storeComment'])->name('comments.store');
        Route::get('{food:slug}', [FoodController::class , 'show'])->name('show');
    });
    // END: FOODS

    // PROFILE
    Route::prefix('profile/')->middleware('auth')->name('profile.')->group(function (){
        Route::get('', [ProfileController::class , 'info'])->name('index');
        Route::get('info',[ProfileController::class , 'info'])->name('info');
        Route::post('update/{user}',[ProfileController::class , 'update'])->middleware('throttle:3,1')->name('update');
        Route::get('orders',[ProfileController::class , 'orders'])->name('orders');
        Route::get('orders/{order}',[ProfileController::class , 'showOrder'])->name('orders.showOrder');
        Route::get('bookmarks',[ProfileController::class , 'bookmarks'])->name('bookmarks');
        Route::get('comments',[ProfileController::class , 'comments'])->name('comments');
        Route::prefix('addresses/')->name('addresses.')->group(function (){
            Route::get('',[AddressController::class , 'index'])->name('index');
            Route::get('create',[AddressController::class , 'create'])->name('create');
            Route::post('store',[AddressController::class , 'store'])->name('store');
            Route::put('{user_address}/update',[AddressController::class , 'update'])->name('update');
            Route::delete('{user_address}/delete',[AddressController::class , 'destroy'])->name('destroy');
        });
        Route::get('resetPassword',[ProfileController::class , 'resetPassword'])->name('resetPassword');
        Route::post('resetPasswordCheck',[ProfileController::class , 'resetPasswordCheck'])->middleware('throttle:3,1')->name('resetPasswordCheck');
        Route::get('verifyEmail',[ProfileController::class , 'verifyEmail'])->name('verifyEmail');
        Route::get('logout',[ProfileController::class , 'logout'])->name('logout');
    });
    // END: PROFILE

    // START: CART
    Route::post('add-to-cart', [CartController::class , 'add'])->name('cart.add');
    Route::get('remove-from-cart/{rowId}', [CartController::class , 'remove'])->name('cart.remove');
    Route::get('clear-cart', [CartController::class , 'clear'])->name('cart.clear');
    Route::prefix('cart/')->middleware('auth')->name('cart.')->group(function (){
        Route::post('{shop:slug}/checkCoupon', [CartController::class , 'checkCoupon'])->name('checkCoupon');
        Route::get('{shop_id}/checkout', [CartController::class , 'checkout'])->name('checkout');
    });
    // END: CART

});
// END: HOME

// ADMIN
Route::prefix('/management/')->name('admin.')->group(function (){

    // START: MAIN
    Route::get('' , [AdminMainController::class, 'index'])->name('index');
    // END: MAIN

    // START: USERS
    Route::resource('users' , AdminUserController::class);
    Route::get('usersSearch', [AdminUserController::class , 'search'])->name('users.search');
    // END: USERS

    // START: CATEGORIES
    Route::get('categories/trash', [AdminCategoryController::class , 'trash'])->name('categories.trash');
    Route::delete('categories/{category}/forceDelete', [AdminCategoryController::class , 'forceDelete'])->name('categories.forceDelete');
    Route::post('categories/{category}/restore', [AdminCategoryController::class , 'restore'])->name('categories.restore');
    Route::resource('categories' , AdminCategoryController::class);
    Route::get('categoriesSearch', [AdminCategoryController::class , 'search'])->name('categories.search');
    Route::get('categoriesSearchFromTrash', [AdminCategoryController::class , 'searchFromTrash'])->name('categories.searchFromTrash');
    // END: CATEGORIES

    // START: INGREDIENTS
    Route::get('ingredients/trash', [AdminIngredientController::class , 'trash'])->name('ingredients.trash');
    Route::resource('ingredients' , AdminIngredientController::class);
    Route::get('ingredientsSearch', [AdminIngredientController::class , 'search'])->name('ingredients.search');
    // END: INGREDIENTS

    // START: FOODS
    Route::get('foods/trash', [AdminFoodController::class , 'trash'])->name('foods.trash');
    Route::delete('foods/{food}/forceDelete', [AdminFoodController::class , 'forceDelete'])->name('foods.forceDelete');
    Route::post('foods/{food}/restore', [AdminFoodController::class , 'restore'])->name('foods.restore');
    Route::resource('foods' , AdminFoodController::class);
    Route::get('foodsSearch', [AdminFoodController::class , 'search'])->name('foods.search');
    Route::get('foodsSearchFromTrash', [AdminFoodController::class , 'searchFromTrash'])->name('foods.searchFromTrash');
    Route::delete('/foods/{food}/destroy-images', [AdminFoodImageController::class , 'destroy'])->name('foods.images.destroy');
    Route::put('/foods/{food}/set-to-primary', [AdminFoodImageController::class , 'set_primary'])->name('foods.images.set_primary');
    Route::post('/foods/{food}/add-images', [AdminFoodImageController::class , 'add'])->name('foods.images.add');
    // END: FOODS

    // START: SHOPS
    Route::get('shops/trash', [AdminShopController::class , 'trash'])->name('shops.trash');
    Route::delete('shops/{shop}/forceDelete', [AdminShopController::class , 'forceDelete'])->name('shops.forceDelete');
    Route::post('shops/{shop}/restore', [AdminShopController::class , 'restore'])->name('shops.restore');
    Route::resource('shops' , AdminShopController::class);
    Route::get('shopsSearch', [AdminShopController::class , 'search'])->name('shops.search');
    Route::get('shopsSearchFromTrash', [AdminShopController::class , 'searchFromTrash'])->name('shops.searchFromTrash');
    Route::get('{shop}/foods', [AdminShopController::class , 'foods'])->name('shops.foods');
    // END: SHOPS

    // START: BANNERS
    Route::get('banners/trash', [AdminBannerController::class , 'trash'])->name('banners.trash');
    Route::delete('banners/{banner}/forceDelete', [AdminBannerController::class , 'forceDelete'])->name('banners.forceDelete');
    Route::post('banners/{banner}/restore', [AdminBannerController::class , 'restore'])->name('banners.restore');
    Route::resource('banners' , AdminBannerController::class);
    Route::get('bannersSearch', [AdminBannerController::class , 'search'])->name('banners.search');
    Route::get('bannersSearchFromTrash', [AdminBannerController::class , 'searchFromTrash'])->name('banners.searchFromTrash');
    // END: BANNERS

    // START: COUPONS
    Route::get('coupons/trash', [AdminCouponController::class , 'trash'])->name('coupons.trash');
    Route::delete('coupons/{coupon}/forceDelete', [AdminCouponController::class , 'forceDelete'])->name('coupons.forceDelete');
    Route::post('coupons/{coupon}/restore', [AdminCouponController::class , 'restore'])->name('coupons.restore');
    Route::resource('coupons' , AdminCouponController::class);
    Route::get('couponsSearch', [AdminCouponController::class , 'search'])->name('coupons.search');
    Route::get('couponsSearchFromTrash', [AdminCouponController::class , 'searchFromTrash'])->name('coupons.searchFromTrash');
    // END: COUPONS

    // START: ORDERS
    Route::resource('orders' , AdminOrderController::class);
    Route::get('ordersSearch', [AdminOrderController::class , 'search'])->name('orders.search');
    // END: ORDERS

    // START: CEREMONIES
    Route::get('ceremonies/trash', [AdminCeremonyController::class , 'trash'])->name('ceremonies.trash');
    Route::delete('ceremonies/{ceremony}/forceDelete', [AdminCeremonyController::class , 'forceDelete'])->name('ceremonies.forceDelete');
    Route::post('ceremonies/{ceremony}/restore', [AdminCeremonyController::class , 'restore'])->name('ceremonies.restore');
    Route::resource('ceremonies' , AdminCeremonyController::class);
    Route::get('ceremoniesSearch', [AdminCeremonyController::class , 'search'])->name('ceremonies.search');
    Route::get('ceremoniesSearchFromTrash', [AdminCeremonyController::class , 'searchFromTrash'])->name('ceremonies.searchFromTrash');
    // END: CEREMONIES

    // START: TABLES
    Route::get('tables/trash', [AdminTableController::class , 'trash'])->name('tables.trash');
    Route::delete('tables/{table}/forceDelete', [AdminTableController::class , 'forceDelete'])->name('tables.forceDelete');
    Route::post('tables/{table}/restore', [AdminTableController::class , 'restore'])->name('tables.restore');
    Route::resource('tables' , AdminTableController::class);
    Route::get('tablesSearch', [AdminTableController::class , 'search'])->name('tables.search');
    Route::get('tablesSearchFromTrash', [AdminTableController::class , 'searchFromTrash'])->name('tables.searchFromTrash');
    // END: TABLES

    // START: RESERVATIONS
    Route::resource('reservations' , AdminReservationController::class);
    Route::get('reservationsSearch', [AdminReservationController::class , 'search'])->name('reservations.search');
    // END: RESERVATIONS

    // START: SETTINGS
    Route::resource('settings' , AdminSettingController::class);
    // END: SETTINGS

    // START: FEEDBACK
    Route::resource('feedback' , AdminFeedbackController::class);
    Route::get('feedbackSearch', [AdminFeedbackController::class , 'search'])->name('feedback.search');
    Route::post('/feedback/{feedback}/response', [AdminFeedbackController::class , 'response'])->name('feedback.response');
    // END: FEEDBACK

    // START: COMMENTS
    Route::resource('comments' , AdminCommentController::class);
    Route::post('comments/{comment}/approve', [AdminCommentController::class , 'approve'])->name('comments.approve');
    Route::post('comments/{comment}/reject', [AdminCommentController::class , 'reject'])->name('comments.reject');
    // END: COMMENTS

});
// END: ADMIN

Auth::routes();
