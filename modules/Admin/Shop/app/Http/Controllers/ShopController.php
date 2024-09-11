<?php

namespace Modules\Admin\Shop\app\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Coupon;
use App\Models\Food;
use App\Models\Ingredient;
use App\Models\Province;
use App\Models\Shop;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ShopController
{
    public function index(): View|Factory|Application
    {
        $shops = Shop::orderBy('status', 'desc')->with('foods', 'city', 'province', 'coupons')->paginate(10);
        $users = User::status()->get();
        $cities = City::all();
        $provinces = Province::all();
        $coupons = Coupon::all();
        return view('AdminShop::Views/index', compact('shops', 'provinces', 'users', 'cities', 'coupons'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validateWithBag('createShop', [
            'title' => ['required',Rule::unique('shops'), 'min:5', 'max:30'],
            'user_id' => ['required'],
            'telephone' => ['required', 'min:10', 'max:11'],
            'telephone2' => ['nullable', 'min:10', 'max:11'],
            'province_id' => ['required'],
            'city_id' => ['required'],
            'address' => ['required', 'min:5', 'max:255'],
            'description' => ['required', 'min:5', 'max:255'],
            'primary_image' => 'required|mimes:jpg,jpeg,png,svg',
            'type' => 'required',
            'status' => 'required'
        ]);

        try {
            DB::beginTransaction();

            $imageName = generateFileName($request->primary_image->getClientOriginalName());
            $request->primary_image->move(public_path(env('SHOP_IMAGE_UPLOAD_PATH')), $imageName);

            Shop::create([
                'title' => $request->title,
                'user_id' => $request->user_id,
                'telephone' => $request->telephone,
                'telephone2' => $request->telephone2,
                'province_id' => $request->province_id,
                'city_id' => $request->city_id,
                'address' => $request->address,
                'description' => $request->description,
                'primary_image' => $imageName,
                'type' => $request->type,
                'status' => $request->status
            ]);

            DB::commit();
        }catch (Exception $ex) {
            DB::rollBack();
            flash()->flash("error", $ex->getMessage(), [], 'مشکلی پیش آمد');
            return redirect()->back();
        }

        flash()->flash("success", 'با موفقیت به رستوران ها اضافه شد.', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function update(Request $request, Shop $shop): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required',Rule::unique('shops')->ignore($request->shop->id), 'min:5', 'max:30'],
            'user_id' => ['required'],
            'telephone' => ['required', 'min:10', 'max:11'],
            'telephone2' => ['nullable', 'min:10', 'max:11'],
            'province_id' => ['required'],
            'city_id' => ['required'],
            'address' => ['required', 'min:5', 'max:255'],
            'description' => ['required', 'min:5', 'max:255'],
            'image' => 'nullable|mimes:jpg,jpeg,png,svg',
            'type' => 'required',
            'status' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator, 'updateShop')->withInput()->with(['shop_id' => $shop->id]);
        }

        try {
            DB::beginTransaction();

            if ($request->primary_image) {
                File::delete(public_path('/uploads/shops/images/'. $shop->primary_image));
                $imageName = generateFileName($request->primary_image->getClientOriginalName());
                $request->primary_image->move(public_path(env('SHOP_IMAGE_UPLOAD_PATH')), $imageName);
            }

            $shop->update([
                'title' => $request->title,
                'user_id' => $request->user_id,
                'telephone' => $request->telephone,
                'telephone2' => $request->telephone2,
                'province_id' => $request->province_id,
                'city_id' => $request->city_id,
                'address' => $request->address,
                'description' => $request->description,
                'primary_image' => $request->primary_image ? $imageName : $shop->primary_image,
                'type' => $request->type,
                'status' => $request->status
            ]);

            DB::commit();
        }catch (Exception $ex) {
            DB::rollBack();
            flash()->flash("error", $ex->getMessage(), [], 'مشکلی پیش آمد');
            return redirect()->back();
        }

        flash()->flash("success", 'رستوران مورد نظر با موفقیت ویرایش شد!', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function destroy(Request $request): RedirectResponse
    {
        Shop::destroy($request->shop);

        flash()->flash("success", 'رستوران مورد نظر با موفقیت حذف شد!', [], 'موفقیت آمیز');
        return redirect()->back();
    }

    public function search(): View|Factory|Application
    {
        $keyword = request()->keyword;
        if (request()->has('keyword') && trim($keyword) != ''){
            $shops = Shop::where('title', 'like', '%' . $keyword . '%')->latest()->paginate(10);
        }else{
            $shops = Shop::latest()->paginate(10);
        }
        $users = User::status()->get();
        $cities = City::all();
        $provinces = Province::all();
        $coupons = Coupon::all();
        return view('AdminShop::Views/index' , compact('shops', 'provinces', 'users', 'cities', 'coupons'));
    }

    public function foods(Shop $shop): View|Factory|Application
    {
        $foods = Food::where('shop_id', '=', $shop->id)->latest()->paginate(10);
        $ingredients = Ingredient::all();
        $categories = Category::status()->get();
        return view('AdminShop::Views/foods' , compact('foods', 'ingredients', 'categories', 'shop'));
    }
}
