<?php

namespace Modules\Home\Cart\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Food;
use App\Models\Shop;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CartController extends Controller
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function add(Request $request): RedirectResponse
    {
        $request->validate([
            'food_id' => 'required',
            'quantity' => 'required'
        ]);
        $food = Food::status()->findOrFail($request->food_id);
        $cart = Cart::where('shop_id', $food->shop->id)->where('user_id', $request->user()->id)->first();
        if (is_null($cart)) {
            $cart = Cart::create([
                'user_id' => $request->user()->id,
                'shop_id' => $food->shop->id
            ]);
        };

        $existingItem = CartItem::where('cart_id', $cart->id)->where('food_id', $food->id)->first();
        if (is_null($existingItem)) {
            CartItem::create([
                'cart_id' => $cart->id,
                'food_id' => $food->id,
                'quantity' => $request->quantity,
                'price' => $food->price,
            ]);
        }else{
            $existingItem->update([
                'quantity' => $existingItem->quantity + $request->quantity
            ]);
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

    public function checkout($shop_id): Application|Factory|View|RedirectResponse
    {
        $user = auth()->user();
        $addresses = auth()->user()->addresses;
        $cart = Cart::where('user_id', $user->id)->where('shop_id', $shop_id)->with('items')->first();
        if ($user->firstname == null || $user->lastname == null || $user->phone_number == null){
            flash()->flash("warning", 'لطفا اطلاعات خود را داخل حساب کاربری کامل کنید', [], 'موفق');
            return redirect()->route('home.profile.info');
        }else{
            return view('Cart::Views/checkout', compact('user', 'addresses', 'cart'));
        }
    }

    public function checkCoupon(Request $request){

        $request->validate([
            'code' => 'required'
        ]);

        $result = checkCoupon($request->code, $request->shop);
        if (array_key_exists('error', $result)){
            flash()->flash("warning", $result['error'], [], 'ناموفق');
            return redirect()->back();
        }else{
            flash()->flash("warning", $result['success'], [], 'موفق');
            return redirect()->back();
        }
    }
}
