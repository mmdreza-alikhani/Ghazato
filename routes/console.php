<?php

use App\Models\Ingredient;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

//Schedule::call(function () {
//    Ingredient::create([
//        'title' => 'aaaaa'
//    ]);
//})->everySecond();
