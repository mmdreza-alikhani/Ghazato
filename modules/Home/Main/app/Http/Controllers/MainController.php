<?php

namespace Modules\Home\Main\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\Food;
use App\Models\Shop;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function index(): View|Factory|Application
    {
        $banners = Banner::status()->where('type' , 'main/top-slider')->orderBy('priority', 'desc')->get();
        $foods = Food::status()->latest()->limit(10)->get();
        $categories = Category::status()->get();

        return view('Main::Views/index' , compact('banners', 'foods', 'categories'));
    }

    public function receiveFeedback(Request $request): RedirectResponse
    {
        if (auth()->check()){
            $request->validateWithBag('createFeedback', [
                'subject' => 'required|string|min:3|max:50',
                'text' => 'required|string|min:3|max:500',
            ]);

            Feedback::create([
                'user_id' => auth()->user()->id,
                'subject' => $request->subject,
                'text' => $request->text
            ]);

            flash()->flash("success", '.به زودی به درخواست شما پاسخ داده میشود', [], 'موفقیت آمیز');
            return redirect()->back();
        }else{
            flash()->flash("info", '.لطفا از قبل وارد شوید', [], 'ناموفق');
            return redirect()->back();
        }
    }

    public function search(): View|Factory|Application
    {
        $keyWord = request()->keyword;
        if (request()->has('keyword') && trim($keyWord) != ''){
            $foods = Food::status()->where('title', 'LIKE', '%'.trim($keyWord).'%')->get();
            $shops = Shop::status()->where('title', 'LIKE', '%'.trim($keyWord).'%')->get();
        }else{
            $foods = $shops = null;
        }
        return view('Main::Views/index', compact('foods', 'shops'));
    }

    public function about(): View|Factory|Application
    {
        return view('Main::Views/about');
    }

}
