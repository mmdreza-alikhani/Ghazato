<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Api\V1\Banner\app\Http\Controllers\BannerController;
use Modules\Api\V1\Category\app\Http\Controllers\CategoryController;
use Modules\Api\V1\Ceremony\app\Http\Controllers\CeremonyController;
use Modules\Api\V1\Comment\app\Http\Controllers\CommentController;
use Modules\Api\V1\Coupon\app\Http\Controllers\CouponController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Route::get('/banners', [AdminBannerController::class, 'api_index']);
//Route::get('/banners/{banner}', [AdminBannerController::class, 'api_show']);
//Route::post('/create_banner', [AdminBannerController::class, 'api_store']);

Route::prefix('v1/')->name('v1.')->group(function (){
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('banners', BannerController::class);
    Route::apiResource('ceremonies', CeremonyController::class);
    Route::apiResource('comments', CommentController::class);
    Route::post('comments/{comment}/approve', [CommentController::class , 'approve'])->name('comments.approve');
    Route::post('comments/{comment}/reject', [CommentController::class , 'reject'])->name('comments.reject');
    Route::apiResource('coupons', CouponController::class);
});
