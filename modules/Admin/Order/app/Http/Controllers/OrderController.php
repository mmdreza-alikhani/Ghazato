<?php

namespace Modules\Admin\Order\app\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class OrderController
{
    public function index(): View|Factory|Application
    {
        $orders = Order::with('transaction', 'address', 'user', 'coupon', 'items')->latest()->paginate(10);
        return view('AdminOrder::Views/index', compact('orders'));
    }

    public function search(): View|Factory|Application
    {
        $keyword = request()->keyword;
        if (request()->has('keyword') && trim($keyword) != ''){
            $orders = Order::where('id', 'like', '%' . $keyword . '%')->latest()->paginate(10);
        }else{
            $orders = Order::latest()->paginate(10);
        }
        $transactions = Transaction::first();
        return view('AdminOrder::Views/index' , compact('orders', 'transactions'));
    }
}
