<?php

use App\Models\City;
use App\Models\Table;
use Hekmatinasser\Verta\Verta;
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
use Modules\Home\Food\app\Http\Controllers\FoodController;
use Modules\Home\Main\app\Http\Controllers\MainController;
use Modules\Home\Shop\app\Http\Controllers\ShopController;
use Modules\Home\Reservation\app\Http\Controllers\ReservationController;

// PUBLIC
    Route::get('get_province_cities_list', function (Request $request) {
        return City::where('province_id', $request->province_id)->get();
    });
    Route::get('get_available_shop_tables_list', function (Request $request) {
        $pattern = "#[/\s]#";
        $splitedSolarDate = preg_split($pattern, $request->date);
        $gregorianFormat = Verta::jalaliToGregorian($splitedSolarDate[0],$splitedSolarDate[1],$splitedSolarDate[2]);
        $date = implode("-" , $gregorianFormat) . " " . '00:00:00';
        return $freeTables = Table::where('shop_id', $request->shop_id)->whereDoesntHave('reservations', function ($query) use ($date) {
            $query->where('date', $date);
        })->get();
    });
// END:PUBLIC

// HOME
Route::prefix('/')->name('home.')->group(function (){

    // MAIN
    Route::get('' , [MainController::class, 'index'])->name('index');
    // END: MAIN

    // FEEDBACKS
    Route::post('send-feedback' , [MainController::class, 'receiveFeedback'])->name('receiveFeedback');
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

    // RESERVATIONS
    // END: RESERVATIONS

    // FOODS
    Route::prefix('foods/')->name('foods.')->group(function (){
        Route::post('comment/{food}', [FoodController::class , 'storeComment'])->name('comments.store');
        Route::get('{food:slug}', [FoodController::class , 'show'])->name('show');
    });
    // END: FOODS

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
    Route::resource('categories' , AdminCategoryController::class);
    Route::get('categoriesSearch', [AdminCategoryController::class , 'search'])->name('categories.search');
    // END: CATEGORIES

    // START: INGREDIENTS
    Route::resource('ingredients' , AdminIngredientController::class);
    Route::get('ingredientsSearch', [AdminIngredientController::class , 'search'])->name('ingredients.search');
    // END: INGREDIENTS

    // START: FOODS
    Route::resource('foods' , AdminFoodController::class);
    Route::get('foodsSearch', [AdminFoodController::class , 'search'])->name('foods.search');
    Route::delete('/foods/{food}/destroy-images', [AdminFoodImageController::class , 'destroy'])->name('foods.images.destroy');
    Route::put('/foods/{food}/set-to-primary', [AdminFoodImageController::class , 'set_primary'])->name('foods.images.set_primary');
    Route::post('/foods/{food}/add-images', [AdminFoodImageController::class , 'add'])->name('foods.images.add');
    // END: FOODS

    // START: INGREDIENTS
    Route::resource('shops' , AdminShopController::class);
    Route::get('shopsSearch', [AdminShopController::class , 'search'])->name('shops.search');
    Route::get('{shop}/foods', [AdminShopController::class , 'foods'])->name('shops.foods');
    // END: INGREDIENTS

    // START: BANNERS
    Route::resource('banners' , AdminBannerController::class);
    // END: BANNERS

    // START: COUPONS
    Route::resource('coupons' , AdminCouponController::class);
    Route::get('couponsSearch', [AdminCouponController::class , 'search'])->name('coupons.search');
    // END: COUPONS

    // START: ORDERS
    Route::resource('orders' , AdminOrderController::class);
    Route::get('ordersSearch', [AdminOrderController::class , 'search'])->name('orders.search');
    // END: ORDERS

    // START: CEREMONIES
    Route::resource('ceremonies' , AdminCeremonyController::class);
    Route::get('ceremoniesSearch', [AdminCeremonyController::class , 'search'])->name('ceremonies.search');
    // END: CEREMONIES

    // START: TABLES
    Route::resource('tables' , AdminTableController::class);
    Route::get('tablesSearch', [AdminTableController::class , 'search'])->name('tables.search');
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
