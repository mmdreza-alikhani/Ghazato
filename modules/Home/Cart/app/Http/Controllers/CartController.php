<?php

namespace Modules\Home\Cart\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Binafy\LaravelCart\Models\Cart;
use Binafy\LaravelCart\Models\CartItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request): RedirectResponse
    {
        $request->validate([
            'food_id' => 'required',
            'quantity' => 'required'
        ]);
        $food = Food::findOrFail($request->food_id);
        $cart = Cart::query()->firstOrCreate(['user_id' => auth()->user()->id]);
        $duplicate_check = $cart->items()->where('itemable_id', $food->id)->get();
        if ($duplicate_check->isEmpty()){
            $cartItem = new CartItem([
                'itemable_id' => $food->id,
                'itemable_type' => $food::class,
                'quantity' => $request->quantity,
            ]);
            $cart->items()->save($cartItem);
        }else{
            $cart->increaseQuantity(item: $food, quantity: $request->quantity);
        }
        flash()->flash("success", 'با موفقیت به سبد خرید اضافه شد!', [], 'موفق');
        return redirect()->back();
    }

    public function remove($rowId)
    {
        \Cart::remove($rowId);

        toastr()->success('محصول مورد نظر با موفقیت از سبد خرید حذف شد!');
        return redirect()->back();
    }

    public function clear(Request $request)
    {
        \Cart::clear();

        toastr()->success('تمامی محصولات سبد خرید با موفقیت حذف شدند!');
        return redirect()->back();
    }

    public function index(){
        return view('home.cart.cart');
    }

    public function update(Request $request){
        $request->validate([
            'quantity' => 'required'
        ]);
        foreach ($request->quantity as $rowId => $quantity){
            $item = \Cart::get($rowId);
            if ($quantity > $item->attributes->quantity){
                toastr()->warning('تعداد محصولات انتخابی بیش از حد مجاز است!');
                return redirect()->back();
            }
            \Cart::update($rowId, array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $quantity
                ),
            ));
        }
        toastr()->success('تعداد محصولات انتخابی با موفقیت ویرایش شد!');
        return redirect()->back();
    }

    public function checkout(){
        $user = auth()->user();
        if ($user->first_name == null || $user->last_name == null || $user->phone_number == null){
            toastr()->warning('لطفا مشخصات خود را در حساب کاربری تکمیل کنید');
            return redirect()->route('home.profile.info');
        }else{
            if (\Cart::isEmpty()){
                toastr()->warning('سبد خرید شما خالی است!');
                return redirect()->back();
            }
            $addresses = UserAddresses::where('user_id', $user->id)->get();
            return view('home.cart.checkout', compact('addresses'));
        }

    }

    public function checkCoupon(Request $request){

        $request->validate([
            'code' => 'required'
        ]);

        if (!auth()->check()){
            toastr()->warning('اول ثبت نام کنید!');
            return redirect()->back();
        }

        $result = checkCoupon($request->code);
        if (array_key_exists('error', $result)){
            toastr()->warning($result['error']);
            return redirect()->back();
        }else{
            toastr()->success($result['success']);
            return redirect()->back();
        }
    }
}
