<?php

namespace Modules\Home\Food\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Food;
use App\Models\FoodRate;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FoodController extends Controller
{
    public function show(Food $food): View|Factory|Application
    {
        $food = Food::where('id', '=' ,$food->id)->with('comments', 'images', 'rates', 'comments', 'ingredients')->first();
        $related = Food::whereHas('ingredients', function ($q) use ($food) {
            return $q->whereIn('title', $food->ingredients->pluck('title'));
        })
            ->where('id', '!=', $food->id)
            ->get();
        return view('Food::Views/index' , compact('food', 'related'));
    }

    public function storeComment(Request $request, Food $food): RedirectResponse
    {
        if (auth()->check()){
            $validator = Validator::make($request->all(), [
                "text" => "required|min:3",
                "rate" => "required|digits_between:1,5",
                "replyOf" => "required",
            ]);

            if ($validator->fails()){
                return redirect()->to(url()->previous() . '#review')->withErrors($validator, 'createComment');
            }

            try {
                DB::beginTransaction();

                Comment::create([
                    'user_id' => auth()->id(),
                    'food_id' => $food->id,
                    'text' => $request->text,
                    'reply_of' => $request->replyOf,
                    'status' => '0'
                ]);

                if ($food->rates()->where( 'user_id', auth()->id())->exists()){
                    $foodRate = $food->rates()->where('user_id', auth()->id())->first();
                    $foodRate->update([
                        'rate' => $request->rate,
                    ]);
                }else{
                    FoodRate::create([
                        'user_id' => auth()->id(),
                        'food_id' => $food->id,
                        'rate' => $request->rate
                    ]);
                }

                DB::commit();

                flash()->flash("success", 'نظر شما با موفقیت ثبت شد و در انتظار تایید است!', [], 'موفقیت آمیز');
                return redirect()->back();
            }catch (\Exception $ex){
                DB::rollBack();
                flash()->flash("error", $ex->getMessage(), [], 'مشکلی پیش آمد');
                return redirect()->back();
            }
        }else{
            flash()->flash("warning", 'جهت ثبت نظر ابتدا وارد شوید.', [], 'عملیات ناموفق');
            return redirect()->back();
        }

    }

}
