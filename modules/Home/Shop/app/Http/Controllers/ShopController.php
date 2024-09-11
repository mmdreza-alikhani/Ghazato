<?php

namespace Modules\Home\Shop\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Food;
use App\Models\Shop;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class ShopController extends Controller
{
    public function index(): View|Factory|Application
    {
        $classicShops = Shop::status()->where('type', '=', 'classic')->get();
        $fastfoodShops = Shop::status()->where('type', '=', 'fastfood')->get();

        return view('Shop::Views/index' , compact('classicShops', 'fastfoodShops'));
    }

    public function show(Shop $shop): View|Factory|Application
    {
        $foods = Food::status()->where('shop_id', $shop->id)->get();
        $categories = Category::status()->get();

        return view('Shop::Views/show' , compact('shop', 'foods', 'categories'));
    }
}
